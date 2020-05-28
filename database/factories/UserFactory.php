<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\UserInfo;
use App\UserSettings;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10)
    ];
});

$factory->define(UserInfo::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'age' => $faker->numberBetween(18, 100),
        'gender' => $faker->randomElement(['male', 'female']),
        'profile_picture' => 'picture/default.png',
        'description' => $faker->paragraph
    ];
});

$factory->define(UserSettings::class, function (Faker $faker) {
    return [
        'search_age_from' => $faker->numberBetween(18, 25),
        'search_age_to' => $faker->numberBetween(26, 100),
        'search_male' => $faker->numberBetween(0, 1),
        'search_female' => 1
    ];
});
