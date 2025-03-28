<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminWorkerController extends Controller
{
    public function index(): View
    {
        $workers = Worker::simplePaginate(20);
        return view('admin.workers.index', compact('workers'));
    }
    
    public function create(): View
    {
        return view('admin.workers.create');
    }
    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'hire_date' => 'required',
            'education' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        $worker = new Worker;
        $worker->name = $request->name;
        $worker->surname = $request->surname;
        $worker->patronymic = $request->patronymic;
        $worker->position = $request->position;
        $worker->salary = $request->salary;
        $worker->hire_date = $request->hire_date;
        $worker->education = $request->education;
        $worker->phone_number = $request->phone_number;
        $worker->email = $request->email;
        $worker->save();

        return redirect()->route('admin.workers.index');
    }
    
    public function update(Request $request, Worker $worker): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric',
            'hire_date' => 'required',
            'education' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        $worker->name = $request->name;
        $worker->surname = $request->surname;
        $worker->patronymic = $request->patronymic;
        $worker->position = $request->position;
        $worker->salary = $request->salary;
        $worker->hire_date = $request->hire_date;
        $worker->education = $request->education;
        $worker->phone_number = $request->phone_number;
        $worker->email = $request->email;
        $worker->save();

        return redirect()->route('admin.workers.index');
    }

    public function edit(Worker $worker): View
    {
        return view('admin.workers.edit', compact('worker'));
    }
    
    public function destroy(Worker $worker): RedirectResponse
    {
        $worker->delete(); 
        return redirect()->route('admin.workers.index');
    }

    public function worker_docx(Worker $worker) {
        require_once base_path('/vendor/autoload.php');

        $document = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('/app/templates/template.docx'));

        $document->setValue('name', $worker->name);
        $document->setValue('surname', $worker->surname);
        $document->setValue('patronymic', $worker->patronymic);
        $document->setValue('hire_date', $worker->hire_date);

        $document->saveAs('resignation_letter.docx');

        return response()->download('resignation_letter.docx');;
    }
}
