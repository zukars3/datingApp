<?php

namespace App\Http\Controllers;

use App\User;
use App\UserInfo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $userSettings = $user->settings;

        if ($userSettings->search_female == 1 && $userSettings->search_male == 1) {
            $users = User::whereHas('info', function ($query) use ($userSettings) {
                $query->where('age', '>=', $userSettings->search_age_from)
                    ->where('age', '<=', $userSettings->search_age_to)
                    ->where('user_id', '!=', $userSettings->user_id);
            })
                ->whereDoesntHave('userLiked', function ($query) use ($user) {
                    $query->where('user_one', $user->id);
                })
                ->whereDoesntHave('dislikes', function ($query) use ($user) {
                    $query->where('user_one', $user->id);
                })
                ->paginate(1);
        } elseif ($userSettings->search_female == 1) {
            $users = User::whereHas('info', function ($query) use ($userSettings) {
                $query->where('age', '>=', $userSettings->search_age_from)
                    ->where('age', '<=', $userSettings->search_age_to)
                    ->where('gender', 'female')
                    ->where('user_id', '!=', $userSettings->user_id);
            })
                ->whereDoesntHave('userLiked', function ($query) use ($user) {
                    $query->where('user_one', $user->id);
                })
                ->whereDoesntHave('dislikes', function ($query) use ($user) {
                    $query->where('user_one', $user->id);
                })
                ->paginate(1);
        } elseif ($userSettings->search_male == 1) {
            $users = User::whereHas('info', function ($query) use ($userSettings) {
                $query->where('age', '>=', $userSettings->search_age_from)
                    ->where('age', '<=', $userSettings->search_age_to)
                    ->where('gender', 'male')
                    ->where('user_id', '!=', $userSettings->user_id);
            })
                ->whereDoesntHave('userLiked', function ($query) use ($user) {
                    $query->where('user_one', $user->id);
                })
                ->whereDoesntHave('dislikes', function ($query) use ($user) {
                    $query->where('user_one', $user->id);
                })
                ->paginate(1);
        }

        return view('home', [
            'users' => $users,
            'user' => $user,
        ]);
    }
}
