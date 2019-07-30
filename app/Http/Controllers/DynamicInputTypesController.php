<?php

namespace App\Http\Controllers;

use App\DynamicInputTypes\InputType;
use App\Models\Sellable;
use App\Models\SellableField;
use Illuminate\Http\Request;

class DynamicInputTypesController extends Controller
{

    public static function getDynamicInputTypesHTMLFormFill($fieldable) {
        $json = [];

        foreach ($fieldable->fields as $inputType) {

            $textAreaType = config('dynamicInputTypes.TextAreaInput');
            $textAreaInput = new $textAreaType();

            if ($inputType->input_type == $textAreaInput->input_type) {
                $html = '
                    <div class="form-group">
                        <label for="' . str_replace(' ', '_', $inputType->name) . '">' . $inputType->name . '</label>
                        <textarea class="form-control" id="' . str_replace(' ', '_', $inputType->name) . '" 
                            name="' . str_replace(' ', '_', $inputType->name) . '" 
                            aria-describedby="' . str_replace(' ', '_', $inputType->name) . '-Help" '. $inputType->attributes .'>'. $inputType->value .'</textarea>
                    </div>
                ';
            }
            else {
                $html = '
                    <div class="form-group">
                        <label for="' . str_replace(' ', '_', $inputType->name) . '">' . $inputType->name . '</label>
                        <input class="form-control" type="'. $inputType->input_type .'" id="' . str_replace(' ', '_', $inputType->name) . '" 
                        name="' . str_replace(' ', '_', $inputType->name) . '"  '. $inputType->attributes .' value="'. $inputType->value .'">
                    </div>
                ';
            }

            $json[$inputType->name] = $html;
        }

        return $json;
    }

    public static function getDynamicInputTypesHTMLFormAdd() {
        $json = ['inputs' => []];

        foreach (config('dynamicInputTypes') as $typeClass) {

            $type = new $typeClass();

            $html = '
                <hr>
                <div class="form-group border-dark">
                    <p class="mb-0">'.$type->name.'</p>
                    <small>Insert a value to put a default value, let the field empty if not needed</small>
                    <div class="form-group p-2 dynamic-field-group">
                        <input type="hidden" name="field" value="' . $typeClass . '" class="field">
                ';
            foreach($type->getAttributes() as $name => $attribute) {
                $html .= '
                        <div class="row pb-1" data-toggle="tooltip" data-placement="top" title="'. $attribute .'">
                            <label class="col-4 dynamic-field-label" for="'. str_replace(' ', '_', $type->name) . '-' . $name.'">'.$name.'</label>
                            <input class="col-8 dynamic-field" type="text" id="'. str_replace(' ', '_', $type->name) . '-' . $name.'" name="'. $name.'">
                        </div>
                    ';
            }
            $html .= '
                    </div>
                </div>
            ';

            $json['inputs'][$type->name] = $html;
        }
        return $json;
    }

    public static function fillDbFromInputType(InputType $type, Sellable $sellable) {
        $model = new SellableField();
        $attributes = $type->getAttributes();
        $model->name = array_shift($attributes);
        $model->value = array_shift($attributes);
        $attributesAsText = null;
        foreach ($attributes as $key => $attribute) {
            $attributesAsText .= $key . '="' . $attribute . '" ';
        }
        $model->attributes = $attributesAsText;
        $model->input_type = $type->input_type;
        $model->fieldable()->associate($sellable);
        $model->save();
    }

}
