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

        return response()->json($position);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'position_name' => ['required', 'string', 'max:255', 'unique:positions,position_name']
        ]);

        Positions::create($validated);

        return response()->json(['succes' => true]);
    }
}
