<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class EditUserProfileController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        return view('profile', [
            'user' => $user,
            'userInfo' => $user->info,
            'userSettings' => $user->settings
        ]);
    }
}
