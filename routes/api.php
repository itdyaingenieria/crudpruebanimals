<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CorralesController;
use App\Http\Controllers\AnimalsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// dashboard route
Route::get('/dashboard', [DashboardController::class,'index']);
// pages routes
Route::resource('animales', AnimalsController::class);
Route::resource('corrales', CorralesController::class);
Route::get('corrales/addanimals/{id}', [CorralesController::class,'listar_animals']);
Route::post('/option/value', [CorralesController::class,'option']);
Route::post('corrales/asing_animals', [CorralesController::class,'asignar_animal']);
Route::delete('corrales/eliminar_animals/{id}', [CorralesController::class,'eliminar_animals']);
Route::post('corrales/contaranimals', [CorralesController::class,'contar_animalsxcorrales']);
Route::post('corrales/imprimir', [CorralesController::class,'animalsxcorrales']);