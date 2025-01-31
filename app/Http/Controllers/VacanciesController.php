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
        $vacancies = Vacancies::all();

        return view('vacancies.index', compact('vacancies'))->with('i', (request()->input('page', 1) - 1) * 10);
    }
}
