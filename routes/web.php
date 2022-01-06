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
Route::middleware('auth')->group(function () {
    Route::get('/cups', [\App\Http\Controllers\CupController::class, 'index']);
    Route::get('/cups/create', [\App\Http\Controllers\CupController::class, 'create'])->name('game.create');
    Route::post('/cups', [\App\Http\Controllers\CupController::class, 'store']);
    Route::get('/cups/{cup}/edit', [\App\Http\Controllers\CupController::class, 'edit']);
    Route::get('/cups/{cup}', [\App\Http\Controllers\CupController::class, 'show']);
    Route::patch('/cups/{cup}', [\App\Http\Controllers\CupController::class, 'update']);
    Route::delete('/cups/{cup}', [\App\Http\Controllers\CupController::class, 'destroy']);
    Route::post('/cups/{cup}/restore', [\App\Http\Controllers\CupController::class, 'restore'])->name('cups.restore');
    Route::delete('/cups/{cup}/force_delete', [\App\Http\Controllers\CupController::class, 'force_delete'])->name('cups.force_delete');

    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/users/{user:name}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user:name}/addFriend', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'getAddFriend']);
    Route::get('/users/{user:name}/removeFriend', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'getRemoveFriend']);

    Route::get('/games', [\App\Http\Controllers\GameController::class, 'index'])->name('games');
    Route::get('/games/create', [\App\Http\Controllers\GameController::class, 'create'])->name('game.create');
    Route::post('/games', [\App\Http\Controllers\GameController::class, 'store'])->name('games.store');
    Route::get('/news', [\App\Http\Controllers\GameController::class, 'news'])->name('news');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
