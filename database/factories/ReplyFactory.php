<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'reply' => $faker->text,
        'question_id' => function() {
            return App\Question::all()->random();
        },
        'user_id' => function() {
            return App\User::all()->random();
        }
    ];
});
