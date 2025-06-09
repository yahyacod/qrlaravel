<?php

use App\Http\Controllers\QrController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/qr', [QrController::class, 'generateQr'])->name('qr.generate');
Route::post('/qr', [QrController::class, 'generateQr'])->name('qr.generate');
Route::post('/qr/clean', [QrController::class, 'clean'])->name('qr.clean');
Route::get('/qr/list', [QrController::class, 'index'])->name('qr.index');
Route::get('/qr/{id}/edit', [QrController::class, 'edit'])->name('qr.edit');
Route::put('/qr/{id}', [QrController::class, 'update'])->name('qr.update');
Route::delete('/qr/{id}', [QrController::class, 'destroy'])->name('qr.destroy');
Route::post('/qr/save', [QrController::class, 'save'])->name('qr.save');
Route::post('/qr/save-selected', [QrController::class, 'saveSelected'])->name('qr.saveSelected');