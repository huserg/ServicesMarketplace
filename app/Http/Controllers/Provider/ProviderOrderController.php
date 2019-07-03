<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Sellable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('provider.add-order')->with([
            'sellable' => Sellable::find($request->get('sellable')),
        ]);
    }

    public function createOrder(Request $request) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $request->validate([
            'sellable' => 'required|exists:sellables,id',
            'client' => 'required|exists:users,id',
        ]);

        $sellable = Sellable::find($request->get('sellable'));

        $order = new Order();
        $order->sellable()->associate($sellable);
        $order->client()->associate(User::find($request->get('client')));
        $order->price = $sellable->price;
        $order->save();

        return view('provider.detail-order')->with([
            'success_message' => 'Order placed successfully!',
            'order' => $order,
        ]);
    }

    public function manageOrder(Request $request, $id) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        return view('provider.update-order')->with([
            'order' => Order::find($id),
        ]);
    }

    public function deleteOrder(Request $request, $id) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        Order::find($request->get('id'))->delete();

        return view('provider.list-orders')->with([
            'orders' => Order::with('sellable.owner_id', Auth::id())->orderBy('created_at', 'desc')->get(),
            'success_message' => 'You have successfully deleted the order!',
        ]);
    }

}
