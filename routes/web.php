<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

// Menampilkan halaman QR Code Generator
Route::get('/qr-code', function () {
    return view('qr');
})->name('qr.page');

// Memproses QR Code dan menampilkan dalam grid
Route::post('/generate-qr', function (Request $request) {
    $request->validate([
        'data' => 'required|string'
    ]);

    // Membuat array QR Code
    $qrList = [];
    for ($i = 0; $i < 8; $i++) { // 20 QR Code per halaman
        $qrList[] = QrCode::size(50)->generate($request->input('data'));
    }

    return redirect()->route('qr.page')->with('qrList', $qrList);
})->name('generate.qr');
