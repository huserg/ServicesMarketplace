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
        $field->name = 'Rue et N°';
        $field->description = 'L\'adresse ou se situe votre maison / appartement';
        $field->input_type = 'text';
        $field->attributes = 'placeholder="Entrez votre adresse et n°"';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'NPA + Ville';
        $field->description = 'La ville ou se situe votre maison / appartement';
        $field->input_type = 'text';
        $field->attributes = 'placeholder="Entrez votre NPA et votre ville"';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Surface à laver (estimation en m2)';
        $field->description = 'La surface estimée de vos vitres à nettoyer. Merci de calculer large.';
        $field->input_type = 'number';
        $field->attributes = 'min="10" step="10"';
        $field->value = '';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Numéro de téléphone';
        $field->description = 'Un numéro de téléphone auquel vous êtes atteignable pour prendre rendez-vous.';
        $field->input_type = 'text';
        $field->attributes = 'placeholder="format 0041 xx xxx xx xx"';
        $field->fieldable()->associate($service);
        $field->save();


        $service = Sellable::find(2);

        $field = new SellableField();
        $field->name = 'Description de votre idée';
        $field->description = 'Merci de remplir cette description de manière la plus précise possible.';
        $field->input_type = 'textarea';
        $field->attributes = 'rows="10';
        $field->fieldable()->associate($service);
        $field->save();

        $service = Sellable::find(3);

        $field = new SellableField();
        $field->name = 'Lieu souhaité';
        $field->description = 'Merci d\'indiquer un lieu situé en Valais.';
        $field->input_type = 'text';
        $field->attributes = 'placeholder="Entrez le lieu souhaité"';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Nombre de personnes';
        $field->description = 'Combien de personnes participeront à la visite.';
        $field->input_type = 'number';
        $field->attributes = 'min="3" max="15"';
        $field->fieldable()->associate($service);
        $field->save();

        $field = new SellableField();
        $field->name = 'Date de la visite';
        $field->description = 'La date à laquelle vous souhaitez votre visite. Les visites commencent le 15 Septembre 2019';
        $field->input_type = 'date';
        $field->attributes = 'min="2019-09-15"';
        $field->value = '2019-09-15';
        $field->fieldable()->associate($service);
        $field->save();

    }
}
