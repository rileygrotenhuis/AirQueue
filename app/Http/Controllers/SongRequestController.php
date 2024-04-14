<?php

namespace App\Http\Controllers;

use App\Models\SongRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class SongRequestController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('SongRequest', [
            'liveSessions' => $request->user()->liveSessions,
        ]);
    }

    public function approve(Request $request, SongRequest $songRequest): RedirectResponse
    {
        Gate::authorize('isOwner', $songRequest);

        // TODO: Implement Spotify API integration to add the song to the live session's playlist.

        $songRequest->delete();

        return to_route('home');
    }

    public function reject(Request $request, SongRequest $songRequest): RedirectResponse
    {
        Gate::authorize('isOwner', $songRequest);

        $songRequest->delete();

        return to_route('home');
    }
}
