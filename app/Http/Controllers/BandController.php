<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BandController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Bands/Index');
    }

    public function create(Request $request): Response
    {
        return Inertia::render('Bands/Create');
    }

    public function show(Request $request, Band $band): Response
    {
        return Inertia::render('Bands/Show');
    }

    public function settings(Request $request, Band $band): Response
    {
        return Inertia::render('Bands/Settings');
    }

    public function invitations(Request $request): Response
    {
        return Inertia::render('Bands/Invitations');
    }
}
