<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/matches', 'MatchesController@matches')->name('matches');

Route::get('/pictures', 'UserPicturesController@show')->name('pictures.show');
Route::post('/pictures', 'UserPicturesController@addPictures')->name('pictures.add');
Route::delete('/pictures/{id}', 'UserPicturesController@destroyPicture')->name('pictures.destroy');

Route::get('/profile/edit', 'EditUserProfileController@show')->name('profile.showEditProfile');
Route::post('/profile/edit', 'EditUserProfileController@updateProfile')->name('profile.updateProfile');
Route::put('/profile/edit', 'EditUserProfileController@updateProfilePicture')->name('profile.updateProfilePicture');

Route::get('/profile/settings', 'EditUserProfileController@showSettings')->name('profile.showSettings');
Route::put('/profile/settings', 'EditUserProfileController@updateSettings')->name('profile.updateSettings');

Route::delete('/profile', 'EditUserProfileController@destroyProfile')->name('profile.destroy');
Route::post('/profile/like/{id}', 'ReactionController@like')->name('like');
Route::post('/profile/dislike/{id}', 'ReactionController@dislike')->name('dislike');
