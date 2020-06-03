<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Match;
use App\Picture;
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
    $gender = $faker->randomElement(['male', 'female']);

    if ($gender == 'male') {
        $firstName = $faker->firstName('male');

        $pictures = [
            'picture/male/male1.jpeg',
            'picture/male/male2.jpeg',
            'picture/male/male3.jpeg',
            'picture/male/male4.jpeg',
            'picture/male/male5.jpeg',
            'picture/male/male6.jpeg',
            'picture/male/male7.jpeg',
            'picture/male/male8.jpeg',
            'picture/male/male9.jpeg',
            'picture/male/male10.jpeg'
        ];
    } else {
        $firstName = $faker->firstName('female');

        $pictures = [
            'picture/female/female1.jpeg',
            'picture/female/female2.jpeg',
            'picture/female/female3.jpeg',
            'picture/female/female4.jpeg',
            'picture/female/female5.jpeg',
            'picture/female/female6.jpeg',
            'picture/female/female7.jpeg',
            'picture/female/female8.jpeg',
            'picture/female/female9.jpeg',
            'picture/female/female10.jpeg',
            'picture/female/pic01.jpg',
            'picture/female/pic02.jpg',
            'picture/female/pic03.jpg',
            'picture/female/pic04.jpg',
            'picture/female/pic05.jpg',
            'picture/female/pic06.jpg',
            'picture/female/pic07.jpg',
            'picture/female/pic08.jpg',
            'picture/female/pic09.jpg',
            'picture/female/pic10.jpg',
            'picture/female/pic11.jpg',
            'picture/female/pic13.jpg',
            'picture/female/pic14.jpg',
            'picture/female/pic15.jpg',
            'picture/female/pic16.jpg'
        ];
    }

    return [
        'name' => $firstName,
        'surname' => $faker->lastName,
        'phone' => $faker->numberBetween(10000000, 99999999),
        'age' => $faker->numberBetween(18, 100),
        'gender' => $gender,
        'profile_picture' => $faker->randomElement($pictures),
        'description' => $faker->paragraph(2),
        'relationship' => $faker->randomElement([
            "Single",
            "Taken",
            "Engaged",
            "Married",
            "It's complicated",
            "Free relationship"
        ]),
        'country' => $faker->country,
        'languages' => $faker->randomElement([
            'Latvian',
            'Russian',
            'English',
            'Latvian and Russian',
            'English and Russian',
            'Spanish',
            'English and Spanish',
            'Russian',
            'French',
            'German',
            'English and French',
            'English and German',
            'Latvian, English and Russian'
        ])
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
