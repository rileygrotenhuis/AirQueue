<?php

namespace App;

use App\Models\SongRequest;
use GuzzleHttp\Client;

trait SpotifyUser
{
    public function addSongToQueue(SongRequest $songRequest): void
    {
        try {
            $client = new Client();

            $response = $client->post('https://api.spotify.com/v1/me/player/queue?uri='.$songRequest->spotify_track_id, [
                'headers' => [
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer '.$this->spotifyTokens->first()->access_token,
                ],
            ]);

            if ($response->getStatusCode() !== 204) {
                logger('Failed to add song to queue');
            }
        } catch (\Exception $e) {
            logger($e->getMessage());
        }
    }
}
