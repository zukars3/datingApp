<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserPicturesRequest;
use App\Picture;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserPicturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(): View
    {
        $user = auth()->user();
        $pictures = $user->pictures;

        return view('pictures', [
            'user' => $user,
            'pictures' => $pictures
        ]);
    }

    public function addPictures(AddUserPicturesRequest $request): RedirectResponse
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
                ->back();
        }
        return redirect()
            ->back();
    }

    public function destroyPicture(int $id): RedirectResponse
    {
        $picture = Picture::find($id);
        $picture->delete();

        return redirect()->back();
    }
}
