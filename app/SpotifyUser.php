<?php

namespace App;

use GuzzleHttp\Client;

trait SpotifyUser
{
    public function addSongToQueue(): void
    {
        try {
            $client = new Client();

            $response = $client->post('https://api.spotify.com/v1/me/player/queue?uri=spotify:track:4iV5W9uYEdYUVa79Axb7Rh', [
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
