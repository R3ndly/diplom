<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WorkersController extends Controller
{
    public function index(): View
    {
        $workers = Worker::paginate(1000);

        return view('workers.index', compact('workers'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

}
