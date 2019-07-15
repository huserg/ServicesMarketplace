<?php

use Illuminate\Database\Seeder;
use \App\Models\SellableField;
use App\Models\Sellable;

class Sellable_FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = Sellable::find(1);

        $field = new SellableField();
        $field->name = 'Localization';
        $field->description = 'The localization of the service';
        $field->input_type = 'text';
        $field->attributes = 'placeholder="Enter your localization"';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Surface (m2)';
        $field->description = 'The surface of the flat';
        $field->input_type = 'number';
        $field->attributes = 'min="10" max="400" step="10"';
        $field->value = '50';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Number of pieces';
        $field->description = 'The number of pieces of the flat';
        $field->input_type = 'number';
        $field->attributes = 'step="0.5"';
        $field->value = '2.5';
        $field->fieldable()->associate($service);
        $field->save();


        $service = Sellable::find(2);

        $field = new SellableField();
        $field->name = 'Localization';
        $field->description = 'The localization of the service';
        $field->input_type = 'text';
        $field->attributes = 'placeholder="Enter your localization"';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Surface (m2)';
        $field->description = 'The surface of the flat';
        $field->input_type = 'number';
        $field->attributes = 'min="10" max="400" step="10"';
        $field->value = '50';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Number of pieces';
        $field->description = 'The number of pieces of the flat';
        $field->input_type = 'number';
        $field->attributes = 'step="0.5"';
        $field->value = '2.5';
        $field->fieldable()->associate($service);
        $field->save();

        $service = Sellable::find(3);

        $field = new SellableField();
        $field->name = 'Localization';
        $field->description = 'The localization of the service';
        $field->input_type = 'text';
        $field->attributes = 'placeholder="Enter your localization"';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Surface (m2)';
        $field->description = 'The surface of the flat';
        $field->input_type = 'number';
        $field->attributes = 'min="10" max="400" step="10"';
        $field->value = '50';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Number of pieces';
        $field->description = 'The number of pieces of the flat';
        $field->input_type = 'number';
        $field->attributes = 'step="0.5"';
        $field->value = '2.5';
        $field->fieldable()->associate($service);
        $field->save();

    }
}
