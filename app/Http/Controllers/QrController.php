<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    public function generateQr(Request $request)
    {
        $kode = $request->input('kode');

        // Membuat array untuk menyimpan beberapa QR Code
        $qrList = [];
        for ($i = 0; $i < 20; $i++) {
            $qrList[] = QrCode::size(50)->generate($kode);
        }

        // Redirect ke halaman QR dengan menyimpan data di session
        return redirect('/qr-code')->with([
            'qrList' => $qrList,
            'kode' => $kode
        ]);
    }
}
