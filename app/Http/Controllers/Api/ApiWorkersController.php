<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\WorkerRequest;
use Illuminate\Support\Facades\DB;

class ApiWorkersController extends Controller
{
    public function index(): JsonResponse
    {
        $workers = Worker::paginate(15);

        return response()->json([
            'success' => true,
            'workers' => $workers
        ]);
    }

    public function store(WorkerRequest $request): JsonResponse
    {
       $validated = $request->validated();

        Worker::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Работник успешно добавлен',
        ]);
    }

    public function show(int $worker_id): JsonResponse
    {
        $worker = Worker::find($worker_id);

        if(!$worker) {
            return response()->json([
                'success' => false,
                'message' => 'Запись не найдена.'
            ]);
        }

        return response()->json([
            'success' => true,
            'worker' => $worker
        ]);
    }


    public function update(WorkerRequest $request, int $worker_id): JsonResponse
    {
        $validated = $request->validated();

        $worker = Worker::find($worker_id);

        if(!$worker) {
            return response()->json([
                'success' => false,
                'message' => 'Запись не найдена.'
            ]);
        }

        $worker->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Данные успешно обновлены',
        ]);
    }

    public function destroy(int $worker_id): JsonResponse
    {
        $worker = Worker::find($worker_id);

        if (!$worker) {
            return response()->json([
                'message' => 'Запись не найдена',
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
