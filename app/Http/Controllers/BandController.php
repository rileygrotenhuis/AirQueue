<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateBandRequest;
use App\Models\Band;
use App\Models\BandUser;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BandController extends Controller
{
    public function index(Request $request): Response
    {
        $bands = $request->user()->bands()->withCount('members')->get();

        return Inertia::render('Bands/Index', [
            'bands' => $bands,
        ]);
    }

    public function store(StoreOrUpdateBandRequest $request): RedirectResponse
    {
        $band = Band::create([
            'owner_id' => $request->user()->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        BandUser::create([
            'band_id' => $band->id,
            'user_id' => $request->user()->id,
            'has_accepted' => true,
        ]);

        return to_route('bands.show', $band);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Bands/Create');
    }

    public function show(Request $request, Band $band): Response
    {
        return Inertia::render('Bands/Show');
    }

    public function update(StoreOrUpdateBandRequest $request, Band $band): RedirectResponse
    {
        Gate::authorize('isOwner', $band);

        $band->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return to_route('bands.show', $band);
    }
}
