<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\BandUser;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BandInvitationController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Bands/Invitations');
    }

    public function accept(Request $request, BandUser $bandUser): RedirectResponse
    {
        Gate::authorize('isInvited', $bandUser);

        $bandUser->update([
            'has_accepted' => true,
        ]);

        return to_route('bands.settings', $bandUser->band);
    }

    public function reject(Request $request, BandUser $bandUser): RedirectResponse
    {
        Gate::authorize('isInvited', $bandUser);

        $bandUser->delete();

        return to_route('bands.invitations');
    }

    public function invite(Request $request, Band $band, User $user): RedirectResponse
    {
        Gate::authorize('isOwner', $band);

        BandUser::create([
            'band_id' => $band->id,
            'user_id' => $user->id,
        ]);

        return to_route('bands.settings', $band);
    }
}
