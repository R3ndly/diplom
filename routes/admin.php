<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminWorkerController;
use App\Http\Controllers\Admin\AdminVacanciesController;
use App\Http\Controllers\Admin\AdminOrdersController;


Route::middleware("admin")->group(function(){
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/about', [HomeController::class, 'about'])->name('about');

    
    
    //Таблицы
    Route::resource('products', AdminProductController::class);
    Route::resource('workers', AdminWorkerController::class);
    Route::resource('orders', AdminOrdersController::class);
    Route::resource('vacancies', AdminVacanciesController::class);

});


Route::get('/login', [AdminController::class, 'index'])->name('login');
Route::post('/login_process', [AdminController::class, 'login'])->name('login_process');


