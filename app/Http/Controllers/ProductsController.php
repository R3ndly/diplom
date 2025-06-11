<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;


class ProductsController extends Controller
{
    public function index(): View
    {
        return view('products.index');
    }
}
