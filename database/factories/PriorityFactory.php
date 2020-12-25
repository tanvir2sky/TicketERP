<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Priority;
use Faker\Generator as Faker;

$factory->define(Priority::class, function (Faker $faker) {
    return [
        'title' => $faker->text(20),
        'color' => $faker->hexColor,
    ];
});
