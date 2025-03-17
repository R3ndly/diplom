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

        return view('vacancies.index', compact('vacancies'));
    }

    public function show(Vacancies $vacancy): View
    {
        $date = date('d-m-Y', strtotime($vacancy->published_at));
        return view('vacancies.show', compact('vacancy', 'date'));
    }
}
