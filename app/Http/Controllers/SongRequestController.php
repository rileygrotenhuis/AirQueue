<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSongRequestRequest;
use App\Models\SongRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class SongRequestController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('SongRequests/Index', [
            'liveSessions' => $request->user()->liveSessions,
        ]);
    }

    public function store(StoreSongRequestRequest $request): RedirectResponse
    {
        $requester = $request->user();

        foreach ($request->input('session_ids') as $session) {
            $users = User::query()->whereHas('liveSessions', function ($query) use ($session) {
                $query->where('live_sessions.id', $session);
            })->get();

            foreach ($users as $user) {
                SongRequest::create([
                    'requester_id' => $requester->id,
                    'user_id' => $user->id,
                    'live_session_id' => $session,
                    'song_name' => $request->input('song_name'),
                    'song_artist' => $request->input('song_artist'),
                    'spotify_image_url' => $request->input('spotify_image_url'),
                    'spotify_track_id' => $request->input('spotify_track_id'),
                    'spotify_track_uri' => $request->input('spotify_track_uri'),
                ]);
            }
        }

        return to_route('home');
    }

    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'search' => ['required', 'string'],
        ]);

        $searchResults = $request->user()->searchSong($request->input('search'));

        return response()->json($searchResults);
    }

    public function approve(Request $request, SongRequest $songRequest): RedirectResponse
    {
        Gate::authorize('isOwner', $songRequest);

        $request->user()->addSongToQueue($songRequest);

        return to_route('home');
    }

    public function reject(Request $request, SongRequest $songRequest): RedirectResponse
    {
        Gate::authorize('isOwner', $songRequest);

        $songRequest->delete();

        return to_route('home');
    }
}
