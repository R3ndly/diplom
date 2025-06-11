<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class OrderController extends Controller
{
    public function create(): View
    {
        return view('orders.create');
    }
}
