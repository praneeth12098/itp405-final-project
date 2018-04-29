<?php

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

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

Route::get('/login/spotify', 'LoginController@redirectToSpotify');
Route::get('/login/spotify/callback', 'LoginController@handleSpotifyCallback');

Route::get('/signup', 'SignupController@index');
Route::post('/signup', 'SignupController@signup');

Route::get('/profile', 'ProfileController@show');
Route::get('/profile/recentTracks', 'ProfileController@getRecentlyPlayed');
Route::get('/profile/topTracks', 'ProfileController@getTopTracks');
Route::get('/profile/topArtists', 'ProfileController@getTopArtists');
Route::get('/profile/subscriptions', 'ProfileController@getSubscriptions');

Route::get('/receiveAlerts', 'TextController@add');
Route::post('/receiveAlerts', 'TextController@store');
Route::get('/receiveAlerts/success', function() {
	return view ('success');
});

Route::post('/searchArtists', 'SearchController@search');
Route::get('/searchArtists', 'SearchController@show');


Route::get('/results/{artist}', 'TextController@view');
Route::post('/results/{artist}', 'TextController@subscribe');
