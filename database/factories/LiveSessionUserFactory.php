<?php

namespace Database\Factories;

use App\Models\LiveSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LiveSessionUserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'live_session_id' => LiveSession::factory(),
            'user_id' => User::factory(),
        ];
    }
}
