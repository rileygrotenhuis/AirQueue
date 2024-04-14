<?php

namespace App\Policies;

use App\Models\SongRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SongRequestPolicy
{
    use HandlesAuthorization;

    public function isOwner(User $user, SongRequest $songRequest): bool
    {
        return $user->id === $songRequest->user_id;
    }
}
