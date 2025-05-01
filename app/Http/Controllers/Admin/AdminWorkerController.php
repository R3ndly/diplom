<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\View\View;

class AdminWorkerController extends Controller
{
    public function index(): View
    {
        return view('admin.workers.index');
    }

    public function create(): View
    {
        return view('admin.workers.create');
    }


    public function edit(Worker $worker): View
    {
        return view('admin.workers.edit');
    }
}
