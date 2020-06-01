<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function matches()
    {
        $user = auth()->user();
        $userSettings = $user->settings;

        $users = User::whereHas('info', function ($query) use ($userSettings) {
            $query->where('age', '>=', $userSettings->search_age_from)
                ->where('age', '<=', $userSettings->search_age_to)
                ->where('user_id', '!=', $userSettings->user_id);
        })
            ->whereHas('userLiked', function ($query) use ($user) {
                $query->where('user_one', $user->id);
            })
            ->whereHas('likedUser', function ($query) use ($user) {
                $query->where('user_two', $user->id);
            })
            ->whereDoesntHave('dislikes', function ($query) use ($user) {
                $query->where('user_one', $user->id);
            })
            ->get();

        return view('matches', [
            'users' => $users,
            'user' => $user,
        ]);
    }

    public function likes()
    {
        $user = auth()->user();
        $userSettings = $user->settings;

        $users = User::whereHas('info', function ($query) use ($userSettings) {
            $query->where('age', '>=', $userSettings->search_age_from)
                ->where('age', '<=', $userSettings->search_age_to)
                ->where('user_id', '!=', $userSettings->user_id);
        })
            ->whereHas('userLiked', function ($query) use ($user) {
                $query->where('user_one', $user->id);
            })
            ->whereDoesntHave('dislikes', function ($query) use ($user) {
                $query->where('user_one', $user->id);
            })
            ->get();

        return view('likes', [
            'users' => $users,
            'user' => $user,
        ]);
    }
}
