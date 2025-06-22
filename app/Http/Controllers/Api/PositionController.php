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

    public function show(int $id): JsonResponse
    {
        $position = Positions::find($id);

        if(!$position) {
            return response()->json([
                'success' => false,
            ], 404);
        }

        return response()->json($position, 200);
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
