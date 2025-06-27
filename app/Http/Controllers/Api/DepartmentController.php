<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(): JsonResponse
    {
        $departmentsData = Department::all();

        return response()->json($departmentsData, 200);
    }

    public function store(Request $request): void
    {
        $validated = $request->valisate([
            'department' => ['required', 'string', 'max:255', 'unique:departments,department']
        ]);

        Department::create($validated);
    }
}
