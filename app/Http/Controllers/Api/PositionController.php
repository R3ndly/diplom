<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Positions;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller
{
    public function index(): JsonResponse
    {
        $position = Positions::all();

        return response()->json($position, 200);
    }

    public function store(Request $request): void
    {
        $validated = $request->validate([
            'position_name' => ['required', 'string', 'max:255', 'unique:positions,position_name']
        ]);

        Positions::create($validated);
    }
}
