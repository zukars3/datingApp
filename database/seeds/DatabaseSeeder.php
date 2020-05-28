<?php

use App\User;
use App\UserInfo;
use App\UserSettings;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function ($user) {
            // Seed the relation with one address
            $userInfo = factory(UserInfo::class)->make();
            $user->info()->save($userInfo);

            // Seed the relation with 5 purchases
            $userSettings = factory(UserSettings::class)->make();
            $user->settings()->save($userSettings);
        });
    }
}
