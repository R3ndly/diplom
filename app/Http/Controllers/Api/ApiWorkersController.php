<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiWorkersController extends Controller
{
    public function index(): JsonResponse
    {
        $workers = DB::table('workers')->paginate(15);

        return response()->json([
            'success' => true,
            'workers' => $workers
        ]);
    }

    public function store(Request $request): JsonResponse
    {
       $validated = $request->validate([
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


        Worker::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Работник успешно добавлен',
        ], 201);
    }

    public function show(int $worker_id): JsonResponse
    {
        $worker = Worker::findOrFail($worker_id);

        return response()->json([
            'success' => true,
            'worker' => $worker
        ]);
    }


    public function update(Request $request, int $worker_id): JsonResponse
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

        $worker = Worker::findOrFail($worker_id);
        $worker->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Данные успешно обновлены',
        ], 201);
    }

    public function destroy(int $worker_id): JsonResponse
    {
        $worker = Worker::find($worker_id);

        if (!$worker) {
            return response()->json([
                'message' => 'Сотрудник не найдена',
            ], 404);
        }

        $worker->delete();

        return response()->json([
            'message' => 'Запись работника успешно удалена',
        ]);
    }

    public function worker_docx(int $worker_id)
    {
        $document = new \PhpOffice\PhpWord\TemplateProcessor('../resources/templates/template.docx');

        $worker = DB::select('
            SELECT name, surname, patronymic, hire_date FROM workers WHERE worker_id = ?', [$worker_id]);

        $document->setValue('name', $worker[0]->name);
        $document->setValue('surname', $worker[0]->surname);
        $document->setValue('patronymic', $worker[0]->patronymic);
        $document->setValue('hire_date', $worker[0]->hire_date);

        $document->saveAs('resignation_letter.docx');

        return response()->download('resignation_letter.docx')->deleteFileAfterSend(true);
    }
}
