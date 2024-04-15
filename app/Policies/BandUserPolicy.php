<?php

namespace App\Policies;

use App\Models\BandUser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BandUserPolicy
{
    use HandlesAuthorization;

    public function isInvited(User $user, BandUser $bandUser): bool
    {
        return $bandUser->user_id === $user->id && $bandUser->has_accepted === false;
    }
}
