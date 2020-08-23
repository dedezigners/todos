<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Question::class, function (Faker $faker) {
    $title = $faker->unique->sentence;

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'description' => $faker->text,
        'category_id' => function() {
            return App\Category::all()->random();
        },
        'user_id' => function() {
            return App\User::all()->random();
        }
    ];
});
