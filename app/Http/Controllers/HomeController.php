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
        $id = $user->id;

        if ($userSettings->search_female == 1 && $userSettings->search_male == 1) {
            $users = User::searchWithSettings(
                $userSettings->search_age_from,
                $userSettings->search_age_to,
                'both',
                $userSettings->user_id
            )
                ->searchWithoutLikesAndDislikes($id)
                ->first();
        } elseif ($userSettings->search_female == 1) {
            $users = User::searchWithSettings(
                $userSettings->search_age_from,
                $userSettings->search_age_to,
                'female',
                $userSettings->user_id
            )
                ->searchWithoutLikesAndDislikes($id)
                ->first();
        } elseif ($userSettings->search_male == 1) {
            $users = User::searchWithSettings(
                $userSettings->search_age_from,
                $userSettings->search_age_to,
                'male',
                $userSettings->user_id
            )
                ->searchWithoutLikesAndDislikes($id)
                ->first();
        }

        return view('home', [
            'otherUser' => $users,
            'user' => $user,
        ]);
    }
}
