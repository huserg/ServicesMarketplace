<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Sellable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientOrderController extends Controller
{

    public function order(Request $request) {
        $request->user()->authorizeRoles(config('auth.ClientAuth'));

        $request->validate([
            'sellable' => 'required|exists:sellables,id'
        ]);

        $sellable = Sellable::find($request->get('sellable'));

        $order = new Order();
        $order->sellable()->associate($sellable);
        $order->client()->associate(Auth::user());
        $order->price = $sellable->price;
        $order->save();

        return view('client.show-order')->with([
            'success_message' => 'Order placed successfully!',
            'order' => $order,
        ]);
    }

    public function showOrder(Request $request, $id) {
        $request->user()->authorizeRoles(config('auth.ClientAuth'));

        return view('client.show-order')->with([
            'order' => Order::find($id)
        ]);
    }

    public function showAll(Request $request){
        $request->user()->authorizeRoles(config('auth.ClientAuth'));

        return view('client.list-orders')->with([
            'orders' => Order::where('client_id', Auth::id())->get()
        ]);

    }

    public function cancel(Request $request) {
        $request->user()->authorizeRoles(config('auth.ClientAuth'));

        $order = Order::find($request->get('id'));
        $order->cancelled_at = Carbon::now()->toDateTimeString();
        $order->save();

        return view('client.show-order')->with([
            'success_message' => 'Order cancelled successfully!',
            'order' => $order,
        ]);
    }

}
