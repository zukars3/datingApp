<?php

namespace App\Http\Controllers;

use App\Services\EmojiService;
use App\Services\RandomUserService;
use Illuminate\View\View;

class HomeController extends Controller
{
    private EmojiService $emojiService;
    private RandomUserService $randomUserService;

    public function __construct(EmojiService $emojiService, RandomUserService $randomUserService)
    {
        $this->middleware('auth');
        $this->emojiService = $emojiService;
        $this->randomUserService = $randomUserService;
    }

    public function index(): View
    {
        $user = auth()->user();
        $userSettings = $user->settings;

        $otherUser = $this->randomUserService->getUser($user, $userSettings);

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
