<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'name' => 'Client'
    ];
});

$factory->state(Role::class, 'Service Provider', [
    'name' => 'Service Provider',
]);
