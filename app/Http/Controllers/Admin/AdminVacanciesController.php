<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancies;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminVacanciesController extends Controller
{
    public function index(): View
    {
        return view('admin.vacancies.index');
    }
    
    public function create(): View
    {
        return view('admin.vacancies.create');
    }

    public function show($vacancy_id): View
    {
        return view('admin.vacancies.show');
    }

    public function edit(): View
    {
        return view('admin.vacancies.edit');
    }        
}
