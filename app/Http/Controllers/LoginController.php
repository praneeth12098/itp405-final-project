<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\User;
use SpotifyWebAPI;
// use Session;

require 'vendor/autoload.php';

class LoginController extends Controller
{
    public function index() {
    	return view('login');
    }

    public function redirectToSpotify() {
        return Socialite::driver('spotify')
                ->scopes(['user-read-recently-played', 'user-top-read'])
                ->redirect();
    }

    public function handleSpotifyCallback() {
        $spotifyUser = Socialite::driver('spotify')->user();

        $user = User::where('name', '=', $spotifyUser->getName())->first();

        if (!$user) {
            $user = new User();
            $user->name = $spotifyUser->getName();
            // $user->email = $spotifyUser->getEmail();
            // if(!$user->email) {
            // 	$user->email = "none";
            // }
        }

        $user->spotify_token = $spotifyUser->token;
        $tokenArray = $spotifyUser->accessTokenResponseBody;
        $user->spotify_refresh_token = $tokenArray['refresh_token'];
        
        $user->save();

        Auth::login($user);
        return redirect('/profile');
    }

    public function login() {
    	$loginWasSuccessful = Auth::attempt([
    		'email' => request('email'),
    		'password' => request('password')
    	]);

    	if($loginWasSuccessful) {
    		return redirect('/profile');
    	} else {
    		return redirect('/login');
    	}
    }

    public function logout() {
    	Auth::logout();
    	return redirect('/login');
    }
}
