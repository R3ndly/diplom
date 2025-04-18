<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiVacanciesController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/vacancies', [ApiVacanciesController::class, 'index']);
Route::post('/vacancies', [ApiVacanciesController::class, 'store']);
Route::get('/vacancies/{vacancy}', [ApiVacanciesController::class, 'show']);
Route::put('/vacancies/{vacancy}', [ApiVacanciesController::class, 'update']);
Route::delete('/vacancies/{vacancy}', [ApiVacanciesController::class, 'destroy']);
