<?php

namespace App\Http\Controllers;

use App\Dislike;
use App\Match;
use App\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like(int $id)
    {
        $user = auth()->user();

        Match::create([
            'user_one' => $user->id,
            'user_two' => $id
        ]);

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
