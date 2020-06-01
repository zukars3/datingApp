<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Match;
use App\User;
use Faker\Generator as Faker;

$factory->define(Match::class, function (Faker $faker) {
    $usersCount = User::all()->count();
    return [
        'user_one' => $faker->numberBetween(1, $usersCount),
        'user_two' => $faker->numberBetween(1, $usersCount)
    ];
});
