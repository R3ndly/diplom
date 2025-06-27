<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Working_hours;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkingHoursController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Working_hours::all();

        return response()->json($data, 200);
    }

    public function store(Request $request): void
    {
        $validated = $request->validate([
            'working_hours' => ['required', 'string', 'max:255', 'unique:working_hours,working_hours']
        ]);

        Working_hours::create($validated);
    }
}
