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
    }

    public function index(Request $request) {

        return view( 'client.display-all')->with(['sellables' => Sellable::all()->sortBy('lastModified')]);
    }

    public function details(Request $request, $id) {

        $sellable = Sellable::find($id);

        return view('client.show-details')->with([
            'sellable' => $sellable,
            'fields' => DynamicInputTypesController::getDynamicInputTypesHTMLFormFill($sellable),
        ]);
    }



}
