<?php

namespace App\Http\Controllers;

use App\Models\Vacancies;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class VacanciesController extends Controller
{
    public function index(): View
    {
        return view('vacancies.index');
    }

    public function show(): View
    {
        return view('vacancies.show');
    }
}
