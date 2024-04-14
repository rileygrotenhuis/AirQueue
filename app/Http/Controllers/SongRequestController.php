<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequestRequest;
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

    public function store(StoreSongRequestRequest $request): RedirectResponse
    {
        $user = $request->user();

        SongRequest::create([
            'requester_id' => $user->id,
            'user_id' => $user->id,
            'live_session_id' => $request->input('session_ids')[0],
            'song_name' => $request->input('song_name'),
            'song_artist' => $request->input('song_artist'),
            'spotify_image_url' => 'https://via.placeholder.com/150',
            'spotify_track_id' => '1234567890',
            'spotify_track_uri' => 'spotify:track:1234567890',
        ]);

        return to_route('home');
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
