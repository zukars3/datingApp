<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfilePictureRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserSettingsRequest;
use App\Picture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EditUserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(): View
    {
        $user = auth()->user();

        return view('profile', [
            'user' => $user,
            'userInfo' => $user->info,
            'userSettings' => $user->settings
        ]);
    }

    public function showSettings(): View
    {
        $user = auth()->user();

        return view('settings', [
            'user' => $user,
            'userInfo' => $user->info,
            'userSettings' => $user->settings
        ]);
    }

    public function updateProfile(UpdateUserProfileRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $userInfo = $user->info;

        $userInfo->update([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'age' => $request->get('age'),
            'description' => $request->get('description'),
            'relationship' => $request->get('relationship'),
            'country' => $request->get('country'),
            'languages' => $request->get('languages')
        ]);

        return redirect()
            ->back()
            ->with('status', 'Profile has been updated.');
    }

    public function updateSettings(UpdateUserSettingsRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $userSettings = $user->settings;

        $searchAgeRange = explode(';', $request->get('search_age_range'));

        $userSettings->update([
            'search_age_from' => $searchAgeRange[0],
            'search_age_to' => $searchAgeRange[1],
            'search_male' => $request->get('search_male'),
            'search_female' => $request->get('search_female')

        ]);

        return redirect()
            ->back()
            ->with('status', 'Settings have been updated.');
    }

    public function updateProfilePicture(UpdateUserProfilePictureRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $userInfo = $user->info;

        Storage::disk('public')->delete($userInfo->profile_picture);

        $userInfo->update([
            'profile_picture' => $request->file('picture')->store('profilePictures', 'public')
        ]);

        return redirect()
            ->back()
            ->with('status', 'Profile has been updated.');
    }

    public function showPictures(): View
    {
        $user = auth()->user();
        $pictures = $user->pictures;

        return view('pictures', [
            'user' => $user,
            'pictures' => $pictures
        ]);
    }

    public function addPictures(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if ($request->hasFile('picture')) {
            foreach ($request->file('picture') as $picture) {
                Picture::create([
                    'user_id' => $user->id,
                    'path' => $picture->store('profilePictures', 'public')
                ]);
            }
            return redirect()
                ->back()
                ->with('status', 'Profile has been updated.');
        }
        return redirect()
            ->back()
            ->with('status', 'Profile update failed.');
    }

    public function destroyPicture(int $id): RedirectResponse
    {
        $picture = Picture::find($id);
        $picture->delete();

        return redirect()->back();
    }

    public function destroyProfile(): RedirectResponse
    {
        $user = Auth::user();

        $user->delete();

        return redirect(route('home'));
    }
}
