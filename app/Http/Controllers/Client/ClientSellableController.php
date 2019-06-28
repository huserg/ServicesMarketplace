<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Sellable;
use Illuminate\Http\Request;

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
}
