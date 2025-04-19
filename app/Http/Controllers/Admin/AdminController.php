<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{

    public function index(): View
    {
        return view("admin.auth.login");
    }


    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            "email" => ["required", "email", "string"],
            "password" => ["required"]
        ]);

        if(auth("admin")->attempt($data)) {
            return redirect(route('admin.products.index'));
        }

        return redirect(route("admin.login"))->withErrors(["email" => "Пользователь не найден, либо данные введены не правильно"]);
    }


    public function logout()
    {
        auth("admin")->logout();

        return redirect(route("/"));
    }
}
