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
        $vacancies = Vacancies::all();
        return view('admin.vacancies.index', compact('vacancies'));
    }
    
    public function create(): View
    {
        return view('admin.vacancies.create');
    }

    public function show(Vacancies $vacancy): View
    {
        $date = date('d-m-Y', strtotime($vacancy->published_at));
        return view('admin.vacancies.show', compact('vacancy', 'date'));
    }

    public function store(Request $request): RedirectResponse
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

        

        $vacancies = new Vacancies;
        $vacancies->title = $request->title;
        $vacancies->description = $request->description;
        $vacancies->department = $request->department;
        $vacancies->location = $request->location;
        $vacancies->type = $request->type;
        $vacancies->salary = $request->salary;
        $vacancies->contact_email = $request->contact_email;
        $vacancies->contact_phone = $request->contact_phone;
        $vacancies->save();

        return redirect()->route('admin.vacancies.index')->with('Выполнено!','Готово!');
    }
    
    public function update(Request $request, Vacancies $vacancy): RedirectResponse
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

        
        $vacancy->title = $request->title;
        $vacancy->description = $request->description;
        $vacancy->department = $request->department;
        $vacancy->location = $request->location;
        $vacancy->type = $request->type;
        $vacancy->salary = $request->salary;
        $vacancy->contact_email = $request->contact_email;
        $vacancy->contact_phone = $request->contact_phone;
        $vacancy->save();

        return redirect()->route('admin.vacancies.index')->with('Выполнено','готово');
    }

    public function edit(Vacancies $vacancy): View
    {
        return view('admin.vacancies.edit', compact('vacancy'));
    }
    
    public function destroy(Vacancies $vacancy): RedirectResponse
    {
        $vacancy->delete(); 
        return redirect()->route('admin.vacancies.index')->with('выполнено','изделие удалёно.');
    }
        
}
