<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vacancies;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ApiVacanciesController extends Controller
{
    public function index()
    {
        $vacancies = Vacancies::simplePaginate(12);

        return response()->json([
            'success' => true,
            'vacancies' => $vacancies
        ]);
    }

    public function show($vacancy_id)
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

    public function store(Request $request)
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

        $vacancy = Vacancies::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Вакансия успешно создана',
            'data' => $vacancy
        ], 201);
    }
}
