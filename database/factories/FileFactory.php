<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\File;
use App\Movie;
use Faker\Generator as Faker;

$factory->define(File::class, function (Faker $faker) {
    $path = public_path(). '/files';
    $file = $faker->image($path, 640, 480, null, false);
    return [
        'name' => $file,
        'mime_type' => 'image/jpg',
        'fileExtension' => $faker->fileExtension,
        'path' => $path.'/'. $file,
        'size' => $faker->numberBetween(1000, 9000),
        'movie_id' => Movie::all()->random()->id
    ];
});
