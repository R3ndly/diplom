<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vacancies;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\VacancyRequest;

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
        $vacancy = Vacancies::find($vacancy_id);

        if(!$vacancy) {
            return response()->json([
                'success' => false,
                'message' => 'Запись не найдена.'
            ], 404);
        }

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

    public function store(VacancyRequest $request): JsonResponse
    {
        $validated = $request->validated();

        Vacancies::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Вакансия успешно создана',
        ], 201);
    }

    public function update(VacancyRequest $request, int $vacancy_id): JsonResponse
    {
        $validated = $request->validated();

        $vacancy = Vacancies::find($vacancy_id);

        if(!$vacancy) {
            return response()->json([
                'success' => false,
                'message' => 'Запись не найдена.'
            ], 404);
        }

        $vacancy->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Вакансия успешно обновлена'
        ]);
    }

    public function destroy(int $vacancy_id): JsonResponse
    {
        $vacancy = Vacancies::find($vacancy_id);

        if (!$vacancy) {
            return response()->json([
                'message' => 'Запись не найдена.',
            ], 404);
        }

        $vacancy->delete();

        return response()->json([
            'success' => true,
            'message' => 'Вакансия успешно удалена',
        ]);
    }
}
