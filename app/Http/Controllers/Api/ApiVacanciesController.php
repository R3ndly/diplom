<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiVacanciesController extends Controller
{
    public function index(): JsonResponse
    {
        $vacancies = Vacancies::paginate(12);

        return response()->json([
            'success' => true,
            'vacancies' => $vacancies
        ]);
    }

    public function show(int $vacancy_id): JsonResponse
    {
        $vacancy = Vacancies::findOrFail($vacancy_id);

        return response()->json([
            'success' => true,
            'vacancy' => [
                'vacancy_id' => $vacancy->vacancy_id,
                'title' => $vacancy->title,
                'description' => $vacancy->description,
                'department' => $vacancy->department,
                'location' => $vacancy->location,
                'type' => $vacancy->type,
                'salary' => $vacancy->salary,
                'published_at' => $vacancy->getFormattedTime(),
                'contact_email' => $vacancy->contact_email,
                'contact_phone' => $vacancy->contact_phone
            ]
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'department' => 'required',
            'location' => 'required',
            'type' => 'required',
            'salary' => 'nullable',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
        ]);

        Vacancies::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Вакансия успешно создана',
        ], 201);
    }

    public function update(Request $request, int $vacancy_id): JsonResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'department' => 'required',
            'location' => 'required',
            'type' => 'required',
            'salary' => 'nullable',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
        ]);

        $vacancy = Vacancies::findOrFail($vacancy_id);
        $vacancy->update($request->all());

        return response()->json(['message' => 'Вакансия успешно обновлена']);
    }

    public function destroy(int $vacancy_id): JsonResponse
    {
        $vacancy = Vacancies::find($vacancy_id);

        if (!$vacancy) {
            return response()->json([
                'message' => 'Вакансия не найдена',
            ], 404);
        }

        $vacancy->delete();

        return response()->json([
            'message' => 'Вакансия успешно удалена',
        ]);
    }
}
