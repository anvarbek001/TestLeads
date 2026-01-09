<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Leads;
use App\Tasks;
use Faker\Generator as Faker;

$factory->define(Tasks::class, function (Faker $faker) {
    return [
        'lead_id' => Leads::inRandomOrder()->first()->id,
        'title'   => $faker->sentence(3),
        'due_at'  => $faker->optional()->dateTimeBetween('now', '+10 days'),
        'is_done' => $faker->boolean,
    ];
});
