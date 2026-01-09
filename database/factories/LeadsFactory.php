<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Leads;
use Faker\Generator as Faker;

$factory->define(Leads::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'phone' => $faker->numerify('998#########'),
        'status' => $faker->randomElement(['new', 'in_progress', 'done']),
        'note' => $faker->optional()->sentence,
    ];
});
