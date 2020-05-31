<?php

use App\Match;
use App\User;
use Illuminate\Support\Facades\DB;
use App\UserInfo;
use App\UserSettings;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        factory(User::class, 100)->create()->each(function ($user) {
            $userInfo = factory(UserInfo::class)->make();
            $user->info()->save($userInfo);

            $userSettings = factory(UserSettings::class)->make();
            $user->settings()->save($userSettings);
        });

        $usersCount = User::all()->count();

        for ($i = 0; $i < 100; $i++) {
            DB::table('matches')->insert([
                'user_one' => $faker->numberBetween(1, $usersCount),
                'user_two' => $faker->numberBetween(1, $usersCount),
                'matched' => 1
            ]);
        }
    }
}
