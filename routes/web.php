<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminWorkerController;
use App\Http\Controllers\WorkersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminVacanciesController;
use App\Http\Controllers\VacanciesController;

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
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        

        Route::get('/vacancies', [VacanciesController::class, 'index'])->name('vacancies.index');
        Route::get('/vacancies/{vacancy}', [VacanciesController::class, 'show'])->name('vacancies.show');


        Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
        Route::get('/products/filter', [ProductsController::class, 'filter'])->name('products.filter');

        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        
        Route::get('/cart', [CartController::class, 'main'])->name('cart.index');
        Route::post('/cart/{product}/add', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/cart/{cart}/remove', [CartController::class, 'remove'])->name('cart.remove');
});



Route::middleware("guest")->group(function(){
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login_process', [AuthController::class, 'login'])->name('login_procces');

        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/register_process', [AuthController::class, 'register'])->name('register_procces');
});

Route::middleware("admin")->group(function(){
        Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
        Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
        Route::get('/admin/products/filter', [AdminProductController::class, 'filter'])->name('admin.products.filter');

        Route::resource('/admin/vacancies', AdminVacanciesController::class);
});