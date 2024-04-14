<?php

namespace App\Policies;

use App\Models\LiveSession;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LiveSessionPolicy
{
    use HandlesAuthorization;

    public function isMember(User $user, LiveSession $liveSession): bool
    {
        return $liveSession->members->contains($user);
    }
}
