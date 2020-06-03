<?php

namespace App\Http\Controllers;

use App\Dislike;
use App\Mail\SendMatchedEmail;
use App\Mail\SendWelcomeEmail;
use App\Match;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like(int $id)
    {
        $user = auth()->user();
        $otherUser = User::find($id);

        Match::create([
            'user_one' => $user->id,
            'user_two' => $id
        ]);

        if (!$user->match($otherUser) == null) {
            Mail::to($user->email)
                ->queue(new SendMatchedEmail($user, $otherUser));
            Mail::to($otherUser->email)
                ->queue(new SendMatchedEmail($otherUser, $user));
        }

        return redirect(route('home'));
    }

    public function dislike(int $id)
    {
        $user = auth()->user();

        Dislike::create([
            'user_one' => $user->id,
            'user_two' => $id
        ]);

        return redirect(route('home'));
    }
}
