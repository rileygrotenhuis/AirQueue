<?php

namespace App;

use App\Models\SongRequest;
use GuzzleHttp\Client;

trait SpotifyUser
{
    public function checkPlaybackStatus(): bool
    {
        $client = new Client();

        $response = $client->get('https://api.spotify.com/v1/me/player', [
            'headers' => [
                'Authorization' => 'Bearer '.$this->spotifyTokens->first()->access_token,
            ],
        ]);

        if ($response->getStatusCode() === 204) {
            return false;
        }

        return true;
    }

    public function searchSong(string $search): array
    {
        $client = new Client();

        $response = $client->get('https://api.spotify.com/v1/search?q='.$search.'&type=track&limit=10', [
            'headers' => [
                'Authorization' => 'Bearer '.$this->spotifyTokens->first()->access_token,
            ],
        ]);

        logger($response);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function addSongToQueue(SongRequest $songRequest): void
    {
        try {
            $client = new Client();

            $client->post('https://api.spotify.com/v1/me/player/queue?uri='.$songRequest->spotify_track_uri, [
                'headers' => [
                    'content-type' => 'application/json',
                    'Authorization' => 'Bearer '.$this->spotifyTokens->first()->access_token,
                ],
            ]);

            $songRequest->delete();
        } catch (\Exception $e) {
            logger($e->getMessage());
        }
    }
}
