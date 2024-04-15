<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpotifyTokenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'refresh_token' => fake()->uuid(),
            'access_token' => fake()->uuid(),
        ];
    }
}
