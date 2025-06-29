<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vacancies;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\VacancyRequest;
use App\Http\Requests\VacancyCreateRequest;
use Illuminate\Support\Facades\DB;

class ApiVacanciesController extends Controller
{
    public function index(): JsonResponse
    {
        $vacancies = DB::table('vacancies')->select([
            'vacancies.vacancy_id',
            'vacancies.title',
            'vacancies.description',
            'departments.department',
            'locations.location',
            'working_hours.working_hours',
            'workers.phone_number',
            'workers.email',
            'vacancies.salary',
            'vacancies.published_at'
        ])
        ->join('departments', 'vacancies.department_id', '=', 'departments.department_id')
        ->join('locations', 'vacancies.location_id', '=', 'locations.location_id')
        ->join('working_hours', 'vacancies.working_hours_id', '=', 'working_hours.working_hours_id')
        ->join('workers', 'vacancies.worker_id', '=', 'workers.worker_id')
        ->orderBy('vacancies.vacancy_id')
        ->simplePaginate(12);

        return response()->json([
            'success' => true,
            'vacancies' => $vacancies
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $vacancy = DB::table('vacancies')->select([
            'vacancies.vacancy_id',
            'vacancies.title',
            'vacancies.description',
            'departments.department',
            'locations.location',
            'working_hours.working_hours',
            'workers.phone_number',
            'workers.email',
            'vacancies.salary',
            DB::raw("DATE_FORMAT(vacancies.published_at, '%d.%m.%Y') as published_at"),
        ])
        ->join('departments', 'vacancies.department_id', '=', 'departments.department_id')
        ->join('locations', 'vacancies.location_id', '=', 'locations.location_id')
        ->join('working_hours', 'vacancies.working_hours_id', '=', 'working_hours.working_hours_id')
        ->join('workers', 'vacancies.worker_id', '=', 'workers.worker_id')
        ->where('vacancies.vacancy_id', $id)
        ->first();

        if(!$vacancy) {
            return response()->json([
                'success' => false,
                'message' => 'Запись не найдена.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'vacancy' => $vacancy
        ]);
    }

    public function store(VacancyCreateRequest $request): JsonResponse
    {
        Vacancies::create([
            'title' => $request->title,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'location_id' => $request->location_id,
            'working_hours_id' => $request->working_hours_id,
            'worker_id' => $request->worker_id,
            'salary' => $request->salary,
        ]);

        return response()->json([
            'success' => true,
        ], 201);
    }

    public function update(VacancyCreateRequest $request, int $vacancy_id): JsonResponse
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
