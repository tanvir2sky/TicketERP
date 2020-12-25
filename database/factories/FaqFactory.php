<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Faq::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->realText(500)
    ];
});
