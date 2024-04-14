<?php

namespace App\Http\Controllers;

use App\Http\Requests\JoinLiveSessionRequest;
use App\Http\Requests\StoreLiveSessionRequest;
use App\Models\LiveSession;
use App\Models\LiveSessionUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LiveSessionController extends Controller
{
    public function store(StoreLiveSessionRequest $request): RedirectResponse
    {
        $liveSession = LiveSession::create([
            'host_id' => $request->user()->id,
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

    public function show(Request $request, LiveSession $liveSession): Response
    {
        return Inertia::render('LiveSessions/Show', [
            'liveSession' => $liveSession
        ]);
    }
}
