<?php

namespace App\Http\Controllers\Provider;

use App\DynamicInputTypes\InputType;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DynamicInputTypesController;
use App\Models\Sellable;
use App\Models\SellableField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;

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
        // remove token
        array_shift($data);

        $sellable = new Sellable();
        $sellable->type = 1;

        $image = $request->all()['image'];

        if (isset($image)) {
            $file = $request->file('image');
            $name = sha1(date('YmdHis')) . '.' . $file->getClientOriginalExtension();
            $image_path = '/services_img/' . $name;
            $manager = new ImageManager();

            $manager->make($image)
                ->orientate()
                ->save(public_path() . $image_path);

            $sellable->image = $image_path;
        }

        $sellable->name = array_shift($data);
        $sellable->price = array_shift($data);
        $sellable->description = array_shift($data);
        $sellable->owner()->associate(Auth::user());

        $sellable->save();

        $field = null;
        $type = null;

        if (isset($data[0])) {
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
