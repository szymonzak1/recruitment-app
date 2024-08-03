<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

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

Route::get('/', [PetController::class, 'index']);
Route::get('/add',[PetController::class, 'add']);
Route::get('/show/{id}',[PetController::class, 'show']);
Route::get('/edit/{id}', [PetController::class, 'edit']);

Route::post('/store',[PetController::class, 'store']);
Route::put('/update/{id}',[PetController::class, 'update']);
Route::get('/delete/{id}',[PetController::class, 'delete']);
