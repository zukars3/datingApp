<?php

namespace App\Http\Controllers;

use App\UserInfo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(int $id)
    {
        $user = auth()->user();
        $otherUser = UserInfo::find($id);
        $pictures = $otherUser->user->pictures;

        return view('user', [
            'otherUser' => $otherUser,
            'user' => $user,
            'pictures' => $pictures
        ]);
    }
}
