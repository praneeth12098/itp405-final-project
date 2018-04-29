<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use SpotifyWebAPI;

// require 'vendor/autoload.php';

class TextController extends Controller
{
    public function add() {
    	return view('/receiveAlerts');
    }

    // public function showSuccess() {
    // 	return view('/success');
    // }

    public function store(Request $request) {
    	$user = Auth::user();

    	$validation = Validator::make([
    		'phone' => $request->input('phone')
    	], [
    		'phone' => 'required|min:10'
    	]);

    	if($validation->passes()) {

    		$phone = DB::table('phone')
    					->where('id', '=', $user->id)
    					->first();

    		if(!$phone) {
    			DB::table('phone')->insert([
	    			'phone' => $request->input('phone'),
	    			'id' =>$user->id
	    		]);
    		} else if ($phone != $request->input('phone')) {
    			DB::table('phone')
    				->where('id', '=', $user->id)
    				->update([
    					'phone' => $request->input('phone'),
    				]);
    		}

    		// DB::table('phone')->insert([
    		// 	'phone' => $request->input('phone'),
    		// 	'spotify_token' =>$user->spotify_token
    		// ]);

    		return view('/success');
    	} else {
    		return redirect('/receiveAlerts')
    			->withInput()
    			->withErrors($validation);
    	}
    }

    public function success() {
    	return view('/subscribeSuccess');
    }

    public function view($artist) {
    	$user = Auth::user();
    	$token = $user->spotify_token;
    	
    	$api = new SpotifyWebAPI\SpotifyWebAPI();
    	$api->setAccessToken($token);
    	$api->setReturnType(SpotifyWebAPI\SpotifyWebAPI::RETURN_ASSOC);

    	$search = $artist;
    	// $search = str_replace(' ', '+', $search);
    	$startQuery = "artist";
    	// $search = $startQuery."".$search;

    	$searchResults = $api->search($search, $startQuery);

    	// dd($searchResults);

    	$artistArr = $searchResults['artists'];
    	$artistList = $artistArr['items'];
    	$artist = $artistList[0];
    	$artistId = $artist['id'];
    	$imageArr = $artist['images'];
    	$imageInfo = $imageArr[0];
    	$image = $imageInfo['url'];
    	$artist = $artist['name'];

    	return view('/results', [
			'artistId' => $artistId,
			'artist' => $artist,
			'image' => $image
    	]);
    }

    public function subscribe(Request $request, $artist) {
    	$artistId = $request->input('hiddenId');
    	$artist = $request->input('hiddenId1');

    	// dd($artist);

    	$user = Auth::user();
    	$token = $user->spotify_token;
    	
    	// $api = new SpotifyWebAPI\SpotifyWebAPI();
    	// $api->setAccessToken($token);
    	// $api->setReturnType(SpotifyWebAPI\SpotifyWebAPI::RETURN_ASSOC);

    	$results = DB::table('favorites')
    		->where('id', '=', $user->id)
    		->where('artist_id', '=', $artistId)
    		->value('artist_id');

    	// dd($results);

		$alreadySubscribed = False;

		if($artistId == $results) {
			$alreadySubscribed = True;
		}

    	if($alreadySubscribed) {
    		return view('/failedSubscribe');
    	} else {
    		DB::table('favorites')
    			->insert([
    				'id' => $user->id,
    				'artist_id' => $artistId,
    			]);

    		return view('/subscribeSuccess', [
    			'artist' => $artist
    		]);
    	}
    }
}
