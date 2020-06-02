<?php

use App\Jobs\ExampleJob;
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
Route::get('/matches', 'MatchesController@matches')->name('matches');
Route::get('/likes', 'MatchesController@likes')->name('likes');

Route::get('/pictures', 'UpdateUserProfileController@showPictures')->name('pictures.show');
Route::post('/pictures', 'UpdateUserProfileController@addPictures')->name('pictures.add');
Route::delete('/pictures/{id}', 'UpdateUserProfileController@destroyPicture')->name('pictures.destroy');

Route::get('/profile/edit', 'UpdateUserProfileController@show')->name('profile.showEditProfile');
Route::post('/profile/edit', 'UpdateUserProfileController@updateProfile')->name('profile.updateProfile');
Route::put('/profile/edit', 'UpdateUserProfileController@updateProfilePicture')->name('profile.updateProfilePicture');

Route::get('/profile/settings', 'UpdateUserProfileController@showSettings')->name('profile.showSettings');
Route::put('/profile/settings', 'UpdateUserProfileController@updateSettings')->name('profile.updateSettings');

Route::delete('/profile', 'UpdateUserProfileController@destroyProfile')->name('profile.destroy');
Route::get('/profile/{id}', 'UserController@show')->name('user.show');
Route::post('/profile/like/{id}', 'LikeController@like')->name('like');
Route::post('/profile/dislike/{id}', 'LikeController@dislike')->name('dislike');

Route::get('/test', function () {
    ExampleJob::dispatch(100);
});
