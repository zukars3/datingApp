<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'EditUserProfileController')->name('profile');
Route::get('/user/{id}', 'UserController@show')->name('user.show');
Route::put('/profile', 'UpdateUserProfileController')->name('profile.update');
Route::post('/profile/like/{id}', 'LikeController@like')->name('like');
Route::post('/profile/dislike/{id}', 'LikeController@dislike')->name('dislike');

Route::get('/test', function () {
    \App\Jobs\ExampleJob::dispatch(100);
});
