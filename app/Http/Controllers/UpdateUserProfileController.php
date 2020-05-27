<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteUserProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateUserProfileController extends Controller
{
    public function __invoke(CompleteUserProfileRequest $request)
    {
        $user = auth()->user();
        $userInfo = $user->info;

        //Storage::get($user->profile_picture);
        Storage::disk('public')->delete($userInfo->profile_picture);

        $userInfo->update([
            'profile_picture' => $request->file('picture')->store('profilePictures', 'public')
        ]);

        return redirect()
        ->back()
        ->with('status', 'Profile has been updated.');
    }
}
