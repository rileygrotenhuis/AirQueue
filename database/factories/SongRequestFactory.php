<?php

namespace Database\Factories;

use App\Models\LiveSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongRequestFactory extends Factory
{
    public function definition(): array
    {
        return [
            'requester_id' => User::factory(),
            'user_id' => User::factory(),
            'live_session_id' => LiveSession::factory(),
            'song_name' => fake()->name(),
            'song_artist' => fake()->firstName(),
            'spotify_image_url' => fake()->imageUrl(),
            'spotify_track_id' => fake()->uuid(),
            'spotify_track_uri' => fake()->uuid(),
        ];
    }
}
