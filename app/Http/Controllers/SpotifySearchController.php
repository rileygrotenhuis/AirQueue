<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SpotifySearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->get('https://api.spotify.com/v1/search?q='.$request->input('q').'&type=track&limit=25', [
                'headers' => [
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer '.$request->user()->spotifyTokens->first()->access_token,
                ],
            ]);

            return response()->json(json_decode($response->getBody()));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
