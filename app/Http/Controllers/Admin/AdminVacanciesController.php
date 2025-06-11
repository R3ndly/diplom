<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

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

    public function show(): View
    {
        return view('admin.vacancies.show');
    }

    public function edit(): View
    {
        return view('admin.vacancies.edit');
    }
}
