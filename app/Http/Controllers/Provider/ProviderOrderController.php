<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DynamicInputTypesController;
use App\Mail\ClientOrderPlaced;
use App\Mail\ProviderOrderReceived;
use App\Models\Order;
use App\Models\Sellable;
use App\Models\SellableField;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProviderOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showOrders(Request $request) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $orders = Order::whereIn('sellable_id',
            Sellable::select('id')->where('owner_id', Auth::id())->get()->toArray()
        )->orderBy('created_at', 'desc')->get();

        return view('provider.list-orders')->with([
            'orders' => $orders,
            'sellables' => Sellable::where('owner_id', Auth::id())->get(),
        ]);
    }

    public function showOrder(Request $request, $id) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        return view('provider.detail-order')->with([
            'order' => Order::find($id),
        ]);
    }

    public function addOrder(Request $request){
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $sellable = Sellable::find($request->get('sellable'));

        return view('provider.add-order')->with([
            'sellable' => $sellable,
            'fields' => DynamicInputTypesController::getDynamicInputTypesHTMLFormFill($sellable),
        ]);
    }

    public function createOrder(Request $request) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $request->validate([
            'email' => 'required',
        ]);

        $client = User::where('email', $request->get('email'))->first();
        $sellable = Sellable::find($request->get('sellable'));

        if (!isset($client)) {
            return view('provider.add-order')->with([
                'alert_message' => $request->get('email') . ' not found in clients, please enter a valid client email.',
                'sellable' => $sellable,
                'fields' => DynamicInputTypesController::getDynamicInputTypesHTMLFormFill($sellable),
            ]);
        }

        $order = new Order();
        $order->sellable()->associate($sellable);
        $order->client()->associate($client);
        $order->price = $sellable->price;
        // saving new order first
        $order->save();
        // then getting fields
        foreach ($sellable->fields as $s_field) {
            $o_field = new SellableField();
            $o_field->name = $s_field->name;
            $o_field->value = $request->get(str_replace(' ', '_', $s_field->name));
            $o_field->fieldable()->associate($order);
            $o_field->save();
        }

        Mail::to($order->client->email)->send(new ProviderOrderReceived($order));
        Mail::to($order->sellable->owner->email)->send(new ClientOrderPlaced($order));

        return view('provider.detail-order')->with([
            'success_message' => 'Order placed successfully!',
            'order' => $order,
        ]);
    }

    public function manageOrder(Request $request, $id) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $order = Order::find($id);

        return view('provider.update-order')->with([
            'order' => $order,
            'fields' => DynamicInputTypesController::getDynamicInputTypesHTMLFormFill($order),
        ]);
    }

    public function updateOrder(Request $request) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $order = Order::find($request->get('id'));

        foreach($order->fields as $field) {
            $field->value = $request->get($field->name);
        }

        $order->save();

        return view('provider.detail-order')->with([
            'success_message' => 'Order modified successfully!',
            'order' => $order,
            ]);
    }

    public function deleteOrder(Request $request) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        Order::find($request->get('id'))->delete();

        $orders = Order::whereIn('sellable_id',
            Sellable::select('id')->where('owner_id', Auth::id())->get()->toArray()
        )->orderBy('created_at', 'desc')->get();

        return view('provider.list-orders')->with([
            'orders' => $orders,
            'sellables' => Sellable::where('owner_id', Auth::id())->get(),
            'success_message' => 'You have successfully deleted the order!',
        ]);
    }


    public function cancelOrder(Request $request) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $order = Order::find($request->get('id'));
        $order->cancelled_at = Carbon::now()->toDateTimeString();
        $order->save();

        return view('provider.detail-order')->with([
            'success_message' => 'You have successfully cancelled the order!',
            'order' => $order,
        ]);
    }

}
