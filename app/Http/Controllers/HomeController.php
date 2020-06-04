<?php

namespace App\Http\Controllers;

use App\Services\EmojiService;
use App\User;
use App\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    private $emojiService;

    public function __construct(EmojiService $emojiService)
    {
        $this->middleware('auth');
        $this->emojiService = $emojiService;
    }

    public function index()
    {
        $user = auth()->user();
        $userSettings = $user->settings;
        $id = $user->id;

        $otherUser = null;

        if ($userSettings->search_female == 1 && $userSettings->search_male == 1) {
            $otherUser = User::inRandomOrder()
                ->searchWithSettings(
                    $userSettings->search_age_from,
                    $userSettings->search_age_to,
                    'both',
                    $userSettings->user_id
                )
                ->searchWithoutLikesAndDislikes($id)
                ->first();
        } elseif ($userSettings->search_female == 1) {
            $otherUser = User::inRandomOrder()
                ->searchWithSettings(
                    $userSettings->search_age_from,
                    $userSettings->search_age_to,
                    'female',
                    $userSettings->user_id
                )
                ->searchWithoutLikesAndDislikes($id)
                ->first();
        } elseif ($userSettings->search_male == 1) {
            $otherUser = User::inRandomOrder()
                ->searchWithSettings(
                    $userSettings->search_age_from,
                    $userSettings->search_age_to,
                    'male',
                    $userSettings->user_id
                )
                ->searchWithoutLikesAndDislikes($id)
                ->first();
        }

        if ($otherUser == null) {
            $pictures = null;
        } else {
            $pictures = $otherUser->pictures;
        }

        return view('home', [
            'otherUser' => $otherUser,
            'user' => $user,
            'pictures' => $pictures,
            'likeEmoji' => $this->emojiService->getPositiveEmojiUrl(),
            'dislikeEmoji' => $this->emojiService->getNegativeEmojiUrl()
        ]);
    }
}
