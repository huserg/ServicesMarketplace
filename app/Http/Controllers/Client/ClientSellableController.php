<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DynamicInputTypesController;
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

        $sellable = Sellable::find($id);

        return view('client.show-details')->with([
            'sellable' => $sellable,
            'fields' => DynamicInputTypesController::getDynamicInputTypesHTMLFormFill($sellable),
        ]);
    }



}
