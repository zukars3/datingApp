<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\UserInfo;
use App\UserSettings;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        factory(User::class, 500)->create()->each(function ($user) {
            $userInfo = factory(UserInfo::class)->make();
            $user->info()->save($userInfo);

            $userSettings = factory(UserSettings::class)->make();
            $user->settings()->save($userSettings);
        });

        $usersCount = User::all()->count();

        for ($i = 0; $i < 500; $i++) {
            DB::table('matches')->insert([
                'user_one' => $faker->numberBetween(1, $usersCount),
                'user_two' => $faker->numberBetween(1, $usersCount),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            DB::table('pictures')->insert([
                'user_id' => $faker->numberBetween(1, $usersCount),
                'path' => $faker->randomElement([
                    'picture/rand/rand_photo_1.jpg',
                    'picture/rand/rand_photo_3.jpg',
                    'picture/rand/rand_photo_4.jpg',
                    'picture/rand/rand_photo_5.png',
                    'picture/rand/rand_photo_6.jpg',
                    'picture/rand/rand_photo_7.jpg',
                    'picture/rand/rand_photo_8.jpg',
                    'picture/rand/rand_photo_9.jpg',
                    'picture/rand/rand_photo_10.jpg'
                ])
            ]);
        }
    }
}
