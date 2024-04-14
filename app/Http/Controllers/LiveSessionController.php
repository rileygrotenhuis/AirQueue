<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLiveSessionRequest;
use App\Models\Band;
use App\Models\LiveSession;
use App\Models\LiveSessionUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class LiveSessionController extends Controller
{
    public function store(StoreLiveSessionRequest $request): RedirectResponse
    {
        if ($request->input('band_id')) {
            Gate::authorize('isMember', Band::find($request->input('band_id')));
        }

        $liveSession = LiveSession::create([
            'host_id' => $request->user()->id,
            'band_id' => $request->input('band_id'),
            'title' => $request->input('title'),
            'session_key' => $request->input('session_key'),
            'session_passcode' => $request->input('session_passcode'),
        ]);

        LiveSessionUser::create([
            'live_session_id' => $liveSession->id,
            'user_id' => $request->user()->id,
        ]);

        return to_route('live-sessions.show', $liveSession);
    }

    public function join(Request $request): RedirectResponse
    {
        $liveSessionUser = LiveSessionUser::create([
            'live_session_id' => LiveSession::query()->where('session_key', $request->input('session_key'))->first()->id,
            'user_id' => $request->user()->id,
        ]);

        return to_route('live-sessions.show', $liveSessionUser->liveSession);
    }

    public function leave(Request $request, LiveSession $liveSession): RedirectResponse
    {
        Gate::authorize('isMember', $liveSession);

        LiveSessionUser::query()->where('user_id', $request->user()->id)->delete();

        return to_route('home');
    }

    public function show(Request $request, LiveSession $liveSession): Response
    {
        Gate::authorize('isMember', $liveSession);

        $user = $request->user();

        $formattedLiveSession = [
            'id' => $liveSession->id,
            'host_id' => $liveSession->host_id,
            'band_id' => $liveSession->band_id,
            'title' => $liveSession->title,
            'session_key' => $liveSession->session_key,
            'session_passcode' => $liveSession->session_passcode,
            'is_host' => $liveSession->host_id === $user->id,
            'is_member' => $liveSession->members->contains($user),
        ];

        $songRequests = $user->songRequests()->where('live_session_id', $liveSession->id)->get();

        return Inertia::render('LiveSessions/Show', [
            'liveSession' => $formattedLiveSession,
            'songRequests' => $songRequests,
            'members' => $liveSession->members()->get(),
        ]);
    }

    public function destroy(Request $request, LiveSession $liveSession): RedirectResponse
    {
        Gate::authorize('isMember', $liveSession);

        $liveSession->delete();

        return to_route('home');
    }
}
