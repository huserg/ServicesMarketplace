<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesDisplayController extends Controller
{
    public function all(){
        return view( 'services.display-all')->with(['services' => Services::all()->sortBy('lastModified')]);
    }

}
