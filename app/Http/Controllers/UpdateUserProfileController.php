<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateUserProfileController extends Controller
{
    public function __invoke(UpdateUserProfileRequest $request)
    {
        $user = auth()->user();
        $userInfo = $user->info;
        $userSettings = $user->settings;

        if($request->hasFile('picture')){
            Storage::disk('public')->delete($userInfo->profile_picture);

            $userInfo->update([
                'profile_picture' => $request->file('picture')->store('profilePictures', 'public')
            ]);
        }

        $searchAgeRange = explode(';', $request->get('search_age_range'));

        $userSettings->update([
            'search_age_from' => $searchAgeRange[0],
            'search_age_to' => $searchAgeRange[1],
            'search_male' => $request->get('search_male'),
            'search_female' => $request->get('search_female')
        ]);

        return redirect()
        ->back()
        ->with('status', 'Profile has been updated.');
    }
}
