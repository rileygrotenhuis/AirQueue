<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LiveSessionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'host_id' => User::factory(),
            'title' => fake()->title,
            'session_key' => fake()->uuid,
        ];
    }
}
