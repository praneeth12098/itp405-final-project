<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use SpotifyWebAPI;
// use App\Http\Controllers\SpotifyWebAPI\SpotifyWebAPI;

require '/Users/Praneeth/Desktop/SpotifyDash/vendor/autoload.php';

class SearchController extends Controller
{
    //
	public function show() {
		return view('/searchArtists');
	}

	public function view($artistId, $artist, $image) {
		return view('/results', [
			'artist' => $artist,
			'artistId' => $artistId,
			'image' => $image
		]);
	}


    public function search(Request $request) {
    	$user = Auth::user();
    	$token = $user->spotify_token;
    	
    	$api = new SpotifyWebAPI\SpotifyWebAPI();
    	$api->setAccessToken($token);
    	$api->setReturnType(SpotifyWebAPI\SpotifyWebAPI::RETURN_ASSOC);

    	$search = $request->input('name');
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

    	return redirect('/results/'.$artist);
    }
}
