<?php

namespace App;

use App\Models\SongRequest;
use GuzzleHttp\Client;

trait SpotifyUser
{
    public function checkPlaybackStatus(): bool
    {
        $client = new Client();

        if ($this->spotifyTokens->isEmpty()) {
            return false;
        }

        try {
            $response = $client->get('https://api.spotify.com/v1/me/player', [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->spotifyTokens->first()->access_token ?? null,
                ],
            ]);
        } catch (\Exception $e) {
            $this->refreshAccessToken();

            return false;
        }

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

    public function refreshAccessToken(): void
    {
        try {
            $client = new Client();
            $response = $client->post('https://accounts.spotify.com/api/token', [
                'headers' => [
                    'content-type' => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Basic '.base64_encode(config('services.spotify.client_id').':'.config('services.spotify.client_secret')),
                ],
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $this->spotifyTokens->first()->refresh_token,
                    'client_id' => config('services.spotify.client_id'),
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            $this->spotifyTokens()->where('refresh_token', $this->spotifyTokens->first()->refresh_token)->update([
                'access_token' => $data['access_token'],
                'expires_at' => now()->addSeconds($data['expires_in']),
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());
        }
    }
}
