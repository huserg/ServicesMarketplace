<?php

namespace App\Http\Controllers\Provider;

use App\DynamicInputTypes\InputType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DynamicInputTypesController;
use App\Models\Sellable;
use App\Models\SellableField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;

class ProviderSellableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showSellable(Request $request){
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        return view('provider.list-sellable')->with(['sellables' => Sellable::where('owner_id', Auth::id())->orderBy('created_at', 'desc')->get()]);
    }

    public function addSellable(Request $request){
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        return view('provider.add-sellable')->with(
            DynamicInputTypesController::getDynamicInputTypesHTMLFormAdd()
        );
    }

    public function createSellable(Request $request){
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
        ]);

        $data = $request->post();
        array_shift($data);

        $sellable = new Sellable();
        $sellable->type = 1;
        $sellable->image = array_shift($data);
        $sellable->name = array_shift($data);
        $sellable->price = array_shift($data);
        $sellable->description = array_shift($data);
        $sellable->owner()->associate(Auth::user());

        $sellable->save();

        $field = null;
        $type = null;

        if (isset($data)) {
            foreach ($data as $key => $value) {
                if (substr($key, 0,5) == 'field') {
                    if (isset($type))
                        DynamicInputTypesController::fillDbFromInputType($type, $sellable);
                    $type = new $value();
                    $type->clearDefaultAttributes();
                }
                else {
                    $attribute = substr($key, strpos($key, "-") + 1);
                    $type->setAttribute($attribute, $value);
                }
            }
            DynamicInputTypesController::fillDbFromInputType($type, $sellable);
        }

        return view('provider.update-sellable')->with([
            'sellable' => $sellable,
            'success_message' => 'Sellable added successfully !',
        ]);
    }

    public function manageSellable(Request $request, $id){
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $sellable = Sellable::find($id);

        return view('provider.update-sellable')->with([
            'sellable' => $sellable,
            'fields' => DynamicInputTypesController::getDynamicInputTypesHTMLFormFill($sellable),
        ]);
    }

    public function updateSellable(Request $request) {
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        $sellableId = $request->get('id');

        $sellable = Sellable::find($sellableId);

        $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
        ]);

        $sellable->name = $request->get('name');
        $sellable->price = $request->get('price');
        $sellable->description = $request->get('description');

        $sellable->save();

        return view('provider.update-sellable')->with([
            'sellable' => Sellable::find($sellableId),
            'success_message' => 'Sellable updated successfully !',
        ]);
    }

    public function deleteSellable(Request $request){
        $request->user()->authorizeRoles(config('auth.ServiceProviderAuth'));

        Sellable::find($request->get('id'))->delete();

        return view('provider.list-sellable')->with([
            'sellables' => Sellable::where('owner_id', Auth::id())->orderBy('created_at', 'desc')->get(),
            'success_message' => 'You have successfully deleted the sellable!',
        ]);
    }

}
