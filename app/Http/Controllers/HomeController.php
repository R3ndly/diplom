<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function contact(): View
    {
        return view('contact');
    }

    public function about(): View
    {
        return view('about');
    }
}
