<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use SpotifyWebAPI;
// use App\Http\Controllers\SpotifyWebAPI\SpotifyWebAPI;

// require 'vendor/autoload.php';

class ProfileController extends Controller
{
    //

    public function show() {
        return view('/profile');
    }


    public function getRecentlyPlayed() {
    	$user = Auth::user();
    	$token = $user->spotify_token;
    	
    	$api = new SpotifyWebAPI\SpotifyWebAPI();
    	$api->setAccessToken($token);
    	$api->setReturnType(SpotifyWebAPI\SpotifyWebAPI::RETURN_ASSOC);

    	$limit = 10;
    	$recentTracks = $api->getMyRecentTracks($limit);
    	$items = $recentTracks['items'];
        // dd($recentTracks);
    	// dd($items);
    	$tracks = array();
        $artists = array();
        $urls = array();
    	for ($i = 0; $i < 10; $i++) {
    		$item = $items[$i];
    		$track = $item['track'];
            $previewUrl = $track['preview_url'];
    		$name = $track['name'];
            $artistArr = $track['artists'];
            // dd($artistArr);
            $artistInfo = $artistArr[0];
            // dd($artistInfo);
            $artist = $artistInfo['name'];
    		array_push($tracks, $name);
            array_push($artists, $artist);
            array_push($urls, $previewUrl);
    		// $tracks[$i] = $name;
    	}

    	return view('/recentTracks', [
    		'tracks' => $tracks,
            'artists' => $artists,
            'urls' => $urls,
    	]);
    }

    public function getTopTracks() {
        $user = Auth::user();
        $token = $user->spotify_token;
        $id = $user->id;
        // $dd(id);

        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($token);
        $api->setReturnType(SpotifyWebAPI\SpotifyWebAPI::RETURN_ASSOC);

        // $limit = 10;
        $param = 'tracks';
        $topTracks = $api->getMyTop($param);

        $items = $topTracks['items'];
        // dd($items);

        $tracks = array();
        $artists = array();
        $urls = array();
        for ($i = 0; $i < 10; $i++) {
            $item = $items[$i];
            // $track = $item['track'];
            $previewUrl = $item['preview_url'];
            $name = $item['name'];
            $artistArr = $item['artists'];
            // dd($artistArr);
            $artistInfo = $artistArr[0];
            // dd($artistInfo);
            $artist = $artistInfo['name'];
            array_push($tracks, $name);
            array_push($artists, $artist);
            array_push($urls, $previewUrl);
            // $tracks[$i] = $name;
        }

        return view('/topTracks', [
            'tracks1' => $tracks,
            'artists1' => $artists,
            'urls1' => $urls,
        ]);
    }

    public function getTopArtists() {
        $user = Auth::user();
        $token = $user->spotify_token;

        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($token);
        $api->setReturnType(SpotifyWebAPI\SpotifyWebAPI::RETURN_ASSOC);

        $param = 'artists';
        $topArtists = $api->getMyTop($param);
        $items = $topArtists['items'];

        $artists = array();
        $images = array();
        for($i = 0; $i < 10; $i++) {
            $item = $items[$i];
            $name = $item['name'];
            $imageArr = $item['images'];
            $imageInfo = $imageArr[0];
            $image = $imageInfo['url'];

            array_push($artists, $name);
            array_push($images, $image);
        }

        return view('/topArtists', [
            'artists' => $artists,
            'images' => $images,
        ]);
    }

    public function getSubscriptions() {
        $user = Auth::user();
        $token = $user->spotify_token;
        $id = $user->id;
        // dd($id);

        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($token);
        $api->setReturnType(SpotifyWebAPI\SpotifyWebAPI::RETURN_ASSOC);

        // dd($token);
        $results = DB::table('favorites')
            ->where('id', '=', $id)
            ->get();

        // $results = $results['items'];

        // dd($results);
        $artists = array();
        foreach($results as $result) {
            $result = $result->artist_id;
            if(!in_array($result, $artists)) {
                array_push($artists, $result);
            }
        }
        // dd($artists);

        $names = array();
        $images = array();
        foreach($artists as $artistId) {
            $artist = $api->getArtist($artistId);
            $name = $artist['name'];
            $imageArr = $artist['images'];
            $imageInfo = $imageArr[0];
            $image = $imageInfo['url'];

            array_push($names, $name);
            array_push($images, $image);
            // dd($artist);
        }

        return view('/subscriptions', [
            'artists' => $names,
            'images' => $images
        ]);
    }
}
