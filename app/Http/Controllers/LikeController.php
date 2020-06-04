<?php

namespace App\Http\Controllers;

use App\Dislike;
use App\Mail\SendMatchedEmail;
use App\Mail\SendWelcomeEmail;
use App\Match;
use App\Services\ReactionService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LikeController extends Controller
{
    private ReactionService $reactionService;

    public function __construct(ReactionService $reactionService)
    {
        $this->middleware('auth');
        $this->reactionService = $reactionService;
    }

    public function like(int $id)
    {
        $user = auth()->user();
        $otherUser = User::find($id);

        $this->reactionService->like($user, $otherUser);

        return redirect(route('home'));
    }

    public function dislike(int $id)
    {
        $user = auth()->user();
        $otherUser = User::find($id);

        $this->reactionService->dislike($user, $otherUser);

        return redirect(route('home'));
    }
}
