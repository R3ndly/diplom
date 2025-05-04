<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Admin\AdminWorkerController;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Admin\AdminProductController;

use App\Http\Controllers\VacanciesController;
use App\Http\Controllers\Admin\AdminVacanciesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::middleware("auth")->group(function(){
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/vacancies', [VacanciesController::class, 'index'])->name('vacancies.index');
        Route::get('/vacancies/{vacancy}', [VacanciesController::class, 'show'])->name('vacancies.show');

        Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
        Route::get('/products/filter', [ProductsController::class, 'filter'])->name('products.filter');

        Route::get('/orders/create', [OrderController::class, 'create']);

        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
});

Route::middleware("guest")->group(function(){
    Route::controller(AuthController::class)->group(function() {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::get('/register', 'showRegisterForm')->name('register');
    });
});

Route::middleware("admin")->group(function() {
        Route::controller(AdminProductController::class)->group(function () {
                Route::get('/admin/products', 'index')->name('admin.products.index');
                Route::get('/admin/products/create', 'create')->name('admin.products.create');
                Route::post('/admin/products', 'store')->name('admin.products.store');
                Route::get('/admin/products/{product}/edit', 'edit')->name('admin.products.edit');
                Route::put('/admin/products/{product}', 'update')->name('admin.products.update');
                Route::delete('/admin/products/{product}', 'destroy')->name('admin.products.destroy');
                Route::get('/admin/products/filter', 'filter')->name('admin.products.filter');
        });

        Route::controller(AdminVacanciesController::class)->group(function () {
                Route::get('/admin/vacancies', 'index')->name('admin.vacancies.index');
                Route::get('/admin/vacancies/create', 'create')->name('admin.vacancies.create');
                Route::get('/admin/vacancies/{vacancy}', 'show')->name('admin.vacancies.show');
                Route::get('/admin/vacancies/edit/{vacancy}', 'edit')->name('admin.vacancies.edit');
        });

        Route::controller(AdminWorkerController::class)->group(function () {
                Route::get('/admin/workers', 'index')->name('admin.workers.index');
                Route::get('/admin/workers/create', 'create')->name('admin.workers.create');
                Route::get('/admin/workers/edit/{id}', 'edit')->name('admin.workers.edit');
        });
});
