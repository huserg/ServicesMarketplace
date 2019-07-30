<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Sellable;
use Illuminate\Http\Request;

class VisitorSellableController extends Controller
{
    public function index() {
        return view( 'client.display-all')->with(['sellables' => Sellable::all()->sortBy('lastModified')]);
    }
}
