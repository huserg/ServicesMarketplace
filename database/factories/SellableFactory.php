<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Sellable;
use Faker\Generator as Faker;

$factory->define(Sellable::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name' => $faker->name,
        'description' => $faker->text,
        'price' => $faker->numberBetween('1', '10000'),
        'type' => 1,
        'owner_id' => 3,
    ];
});
