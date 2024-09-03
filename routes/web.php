<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\TodoController;

// Route::get('/home', [TodoController::class, 'index'])->name('home');
// Route::get('/home', [App\Http\Controllers\TodoController::class, 'index'])->name('home');
// Route::post('/home', [TodoController::class, 'store']);
// Route::get('/todo/selesai/{id}', [TodoController::class, 'markAsCompleted']);
// Route::get('/todo/hapus/{id}', [TodoController::class, 'destroy']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [TodoController::class, 'index'])->name('home');
    Route::post('/home', [TodoController::class, 'store']);
    Route::get('todo/selesai/{id}', [TodoController::class, 'markAsCompleted']);
    Route::get('todo/batal-selesai/{id}', [TodoController::class, 'markAsUncompleted']);
    Route::get('todo/hapus/{id}', [TodoController::class, 'destroy']);
});


