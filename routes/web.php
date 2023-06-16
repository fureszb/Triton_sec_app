<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UgyfelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SignaturePadController;
use App\Http\Controllers\PDFController;


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

    Route::get('/send-mail',[TestController::class,'sendMailWithPdf']);
    Route::get('send-email-pdf', [PDFController::class, 'index']);


    Route::get('/signaturepad', [SignaturePadController::class, 'index']);
    Route::post('/signaturepad', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');


    Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/ugyfel', [UgyfelController::class, 'store'])->name('ugyfel.store');
    Route::put('/ugyfel/{ugyfel}', [UgyfelController::class, 'update'])->name('ugyfel.update');
    Route::get('/ugyfel/create', [UgyfelController::class, 'create'])->name('ugyfel.create');
    Route::delete('/ugyfel/{ugyfel}', [UgyfelController::class, 'destroy'])->name('ugyfel.destroy');
    Route::get('/ugyfel/{ugyfel}/edit', [UgyfelController::class, 'edit'])->name('ugyfel.edit');

    Route::get('/ugyfel', [UgyfelController::class, 'index'])->name('ugyfel.index');
    Route::get('/ugyfel/{id}', [UgyfelController::class, 'show'])->name('ugyfel.show');

    Route::get('/ugyfel/search', 'UgyfelController@search')->name('ugyfel.search');


});

require __DIR__ . '/auth.php';

