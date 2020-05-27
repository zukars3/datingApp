<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendWelcomeEmail;
use App\Providers\RouteServiceProvider;
use App\User;
use App\UserInfo;
use App\UserSettings;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'surname' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'age' => ['required', 'int', 'min:18', 'max:100'],
            'gender' => ['required'],
            'description' => ['required', 'min:10', 'max:500'],
            'search_age_range' => ['required'],
            'search_male' => ['required_unless:search_female,1'],
            'search_female' => ['required_unless:search_male,1'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $userInfo = UserInfo::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'description' => $data['description']
        ]);

        $searchAgeRange = explode(';', $data['search_age_range']);

        (isset($data['search_male'])) ? $searchMale = 1 : $searchMale = 0;
        (isset($data['search_female'])) ? $searchFemale = 1 : $searchFemale = 0;

        $userSettings = UserSettings::create([
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
