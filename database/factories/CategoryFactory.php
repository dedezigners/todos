<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $word = $faker->unique()->word;

    return [
        'name' => $word,
        'slug' => Str::slug($word),
        'user_id' => function() {
            return App\User::all()->random();
        }
    ];
});
