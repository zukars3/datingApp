<?php

namespace App\Services;

use App\Dislike;
use App\Mail\SendMatchedEmail;
use App\Match;
use Illuminate\Support\Facades\Mail;

class ReactionService
{
    public function like($user, $otherUser)
    {
        Match::create([
            'user_one' => $user->id,
            'user_two' => $otherUser->id
        ]);

        if (!$user->match($otherUser) == null) {
            Mail::to($user->email)
                ->queue(new SendMatchedEmail($user, $otherUser));
            Mail::to($otherUser->email)
                ->queue(new SendMatchedEmail($otherUser, $user));
        }
    }

    public function dislike($user, $otherUser)
    {
        Dislike::create([
            'user_one' => $user->id,
            'user_two' => $otherUser->id
        ]);
    }
}
