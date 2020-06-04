<?php

namespace App\Services;

use App\User;
use App\UserSettings;

class RandomUserService
{
    public function getUser($user, UserSettings $userSettings): ?User
    {
        if ($userSettings->search_female == 1 && $userSettings->search_male == 1) {
            return User::inRandomOrder()
                ->searchWithSettings(
                    $userSettings->search_age_from,
                    $userSettings->search_age_to,
                    'both',
                    $userSettings->user_id
                )
                ->searchWithoutLikesAndDislikes($user->id)
                ->first();
        } elseif ($userSettings->search_female == 1) {
            return User::inRandomOrder()
                ->searchWithSettings(
                    $userSettings->search_age_from,
                    $userSettings->search_age_to,
                    'female',
                    $userSettings->user_id
                )
                ->searchWithoutLikesAndDislikes($user->id)
                ->first();
        } elseif ($userSettings->search_male == 1) {
            return User::inRandomOrder()
                ->searchWithSettings(
                    $userSettings->search_age_from,
                    $userSettings->search_age_to,
                    'male',
                    $userSettings->user_id
                )
                ->searchWithoutLikesAndDislikes($user->id)
                ->first();
        } else {
            return null;
        }
    }
}
