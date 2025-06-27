<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(): JsonResponse
    {
        $locationsData = Location::all();

        return response()->json($locationsData, 200);
    }

    public function store(Request $request): void
    {
        $validated = $request->validate([
            'location' => ['required', 'string', 'max:255', 'unique:locations,location']
        ]);

        Location::create($validated);
    }
}
