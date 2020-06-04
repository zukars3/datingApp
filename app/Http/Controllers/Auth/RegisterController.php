<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendWelcomeEmail;
use App\User;
use App\UserInfo;
use App\UserSettings;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected string $redirectTo = '/profile/edit';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'surname' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:8', 'unique:user_infos'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age' => ['required', 'int', 'min:18', 'max:100'],
            'gender' => ['required'],
            'description' => ['required', 'min:10', 'max:255'],
            'relationship' => ['required'],
            'country' => ['required'],
            'languages' => ['required', 'min:2', 'max:255'],
            'search_age_range' => ['required'],
            'search_male' => ['required_unless:search_female,1'],
            'search_female' => ['required_unless:search_male,1']
        ]);
    }

    protected function create(array $data): User
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        UserInfo::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'profile_picture' => '',
            'description' => $data['description'],
            'relationship' => $data['relationship'],
            'country' => $data['country'],
            'languages' => $data['languages']
        ]);

        $searchAgeRange = explode(';', $data['search_age_range']);

        (isset($data['search_male'])) ? $searchMale = 1 : $searchMale = 0;
        (isset($data['search_female'])) ? $searchFemale = 1 : $searchFemale = 0;

        UserSettings::create([
            'user_id' => $user->id,
            'search_age_from' => $searchAgeRange[0],
            'search_age_to' => $searchAgeRange[1],
            'search_male' => $searchMale,
            'search_female' => $searchFemale

        ]);

        Mail::to($user->email)
            ->queue(new SendWelcomeEmail($user));

        return $user;
    }
}
