<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use App\User;
use Faker\Generator as Faker;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->word(300),
        'description' => $faker->sentence(1000),
        'category' => $faker->word(300),
        'made_in' => $faker->country,
        'user_id' => User::all()->random()->id,
    ];
});
