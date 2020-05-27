<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateUserProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        //Storage::get($user->profile_picture);
        Storage::disk('public')->delete($user->profile_picture);

        $user->update([
            'name' => $request->get('name'),
            'profile_picture' => $request->file('picture')->store('profilePictures', 'public')
        ]);

        return redirect()
        ->back()
        ->with('status', 'Profile has been updated.');
    }
}
