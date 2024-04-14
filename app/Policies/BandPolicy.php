<?php

namespace App\Policies;

use App\Models\Band;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BandPolicy
{
    use HandlesAuthorization;

    public function isMember(User $user, Band $band): bool
    {
        return $band->members->contains($user);
    }

    public function isOwner(User $user, Band $band): bool
    {
        return $user->id === $band->owner_id;
    }
}
