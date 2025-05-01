<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view("auth.login");
    }

    public function showRegisterForm(): View
    {
        return view("auth.register");
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return redirect('/');
    }
}
