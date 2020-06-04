<?php

namespace App\Http\Controllers;

use App\Services\ReactionService;
use App\User;
use Illuminate\Http\RedirectResponse;

class ReactionController extends Controller
{
    private ReactionService $reactionService;

    public function __construct(ReactionService $reactionService)
    {
        $this->middleware('auth');
        $this->reactionService = $reactionService;
    }

    public function like(int $id): RedirectResponse
    {
        $user = auth()->user();
        $otherUser = User::find($id);

        $this->reactionService->like($user, $otherUser);

        return redirect(route('home'));
    }

    public function dislike(int $id): RedirectResponse
    {
        $user = auth()->user();
        $otherUser = User::find($id);

        $this->reactionService->dislike($user, $otherUser);

        return redirect(route('home'));
    }
}
