<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UgyfelController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/ugyfel', [UgyfelController::class, 'store'])->name('ugyfel.store');
    Route::put('/ugyfel/{ugyfel}', [UgyfelController::class, 'update'])->name('ugyfel.update');
    Route::get('/ugyfel/create', [UgyfelController::class, 'create'])->name('ugyfel.create');
    Route::delete('/ugyfel/{ugyfel}', [UgyfelController::class, 'destroy'])->name('ugyfel.destroy');
    Route::get('/ugyfel/{ugyfel}/edit', [UgyfelController::class, 'edit'])->name('ugyfel.edit');

});

require __DIR__.'/auth.php';

Route::get('/ugyfel', [UgyfelController::class, 'index'])->name('ugyfel.index');
Route::get('/ugyfel/{id}', [UgyfelController::class, 'show'])->name('ugyfel.show');
