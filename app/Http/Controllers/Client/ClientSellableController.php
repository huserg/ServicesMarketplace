<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Sellable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientSellableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $request->user()->authorizeRoles(config('auth.ClientAuth'));

        return view( 'client.display-all')->with(['sellables' => Sellable::all()->sortBy('lastModified')]);
    }

    public function details(Request $request, $id) {
        $request->user()->authorizeRoles(config('auth.ClientAuth'));

        return view('client.show-details')->with('sellable', Sellable::find($id));
    }

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

        return view('client.show-order')->with(['order' => Order::find($id)]);
    }


}
