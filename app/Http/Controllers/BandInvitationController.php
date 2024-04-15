<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\BandUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class BandInvitationController extends Controller
{
    public function index(Request $request): Response
    {
        $invitations = $request->user()
            ->bands()
            ->withCount('members')
            ->where('has_accepted', false)
            ->get();

        $invitationCount = $request->user()
            ->bands()
            ->where('has_accepted', false)
            ->count();

        return Inertia::render('Bands/Invitations', [
            'invitations' => $invitations,
            'invitationCount' => $invitationCount,
        ]);
    }

    public function accept(Request $request, BandUser $bandUser): RedirectResponse
    {
        Gate::authorize('isInvited', $bandUser);

        $bandUser->update([
            'has_accepted' => true,
        ]);

        return to_route('bands.show', $bandUser->band);
    }

    public function reject(Request $request, BandUser $bandUser): RedirectResponse
    {
        Gate::authorize('isInvited', $bandUser);

        $bandUser->delete();

        return to_route('bands.invitations');
    }

    public function invite(Request $request, Band $band): RedirectResponse
    {
        Gate::authorize('isOwner', $band);

        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        BandUser::firstOrCreate([
            'band_id' => $band->id,
            'user_id' => User::where('email', $request->input('email'))->first()->id,
        ]);

        return to_route('bands.show', $band);
    }
}
