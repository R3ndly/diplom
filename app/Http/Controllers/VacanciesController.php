<?php

namespace App\Http\Controllers;

use App\Models\Vacancies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VacanciesController extends Controller
{
    public function index(): View
    {
        $vacancies = Vacancies::simplePaginate(12);

        return view('vacancies.index');
    }

    public function show($vacancy_id): View
    {
        return view('vacancies.show', ['vacancy' => $vacancy_id]);
    }
}
