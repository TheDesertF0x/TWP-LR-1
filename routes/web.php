<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cups', [\App\Http\Controllers\CupController::class, 'index']);
Route::get('/cups/create', function (){
   return view('cup.create');
});
Route::post('/cups', [\App\Http\Controllers\CupController::class, 'store']);
Route::get('/cups/{cup}/edit', [\App\Http\Controllers\CupController::class, 'edit']);
Route::get('/cups/{cup}', [\App\Http\Controllers\CupController::class, 'show']);
Route::patch('/cups/{cup}', [\App\Http\Controllers\CupController::class, 'update']);
Route::delete('/cups/{cup}', [\App\Http\Controllers\CupController::class, 'destroy']);

Route::get('/games', [\App\Http\Controllers\GameController::class, 'index']);
Route::get('/games/create', function (){
    return view('game.create');
});
Route::post('/games', [\App\Http\Controllers\GameController::class, 'store']);
Route::get('/games/{game}/edit', [\App\Http\Controllers\GameController::class, 'edit']);
Route::get('/games/{game}', [\App\Http\Controllers\GameController::class, 'show']);
Route::patch('/games/{game}', [\App\Http\Controllers\GameController::class, 'update']);
Route::delete('/games/{game}', [\App\Http\Controllers\GameController::class, 'destroy']);
