<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SpotifyAuthController extends Controller
{
    public function redirect(Request $request): RedirectResponse
    {
        try {
            $authorizationCode = $request->input('code');

            $client = new Client();
            $response = $client->post('https://accounts.spotify.com/api/token', [
                'headers' => [
                    'content-type' => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Basic '.base64_encode(config('services.spotify.client_id').':'.config('services.spotify.client_secret')),
                ],
                'form_params' => [
                    'code' => $authorizationCode,
                    'redirect_uri' => config('services.spotify.redirect'),
                    'grant_type' => 'authorization_code',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            $request->user()->spotifyTokens()->firstOrCreate([
                'refresh_token' => $data['refresh_token'],
                'access_token' => $data['access_token'],
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());
        }

        return to_route('home');
    }
}
