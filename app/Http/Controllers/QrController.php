<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeFacade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class QrController extends Controller
{
    public function generateQr(Request $request)
    {
        $url = null;
        $qrCodesFromXml = null;

        if ($request->isMethod('post')) {
            $request->validate([
                'url' => 'nullable|string|max:255|unique:qr_codes,url',
            ]);

            $request->session()->forget('qr_codes_from_xml');
            Log::info('Session cleared before processing new data.');

            if ($request->filled('url')) {
                $url = $request->input('url');
                Log::info('QR manual URL generated: ' . $url);
            }

            if ($request->hasFile('upload_file')) {
                $file = $request->file('upload_file');
                if ($file->getClientOriginalExtension() === 'xml') {
                    $xmlContent = simplexml_load_file($file->getPathname());
                    if ($xmlContent) {
                        $items = $xmlContent->xpath('//ITEM');
                        $codes = $xmlContent->xpath('//CODE');
                        if (count($items) === count($codes)) {
                            $qrCodesFromXml = [];
                            for ($i = 0; $i < count($items); $i++) {
                                $item = trim((string)$items[$i]);
                                $code = trim((string)$codes[$i]);
                                $qrText = "https://inventaris.com/{$item}_{$code}";
                                $qrCodesFromXml[] = [
                                    'url' => $qrText,
                                    'item' => $item,
                                    'code' => $code,
                                ];
                            }
                            Log::info('QR codes from XML generated: ' . count($qrCodesFromXml));
                            return redirect()->route('qr.generate')
                                ->with('qr_codes_from_xml', $qrCodesFromXml)
                                ->with('success', 'QR codes berhasil digenerate dari file XML. Pilih untuk menyimpan atau cetak.');
                        } else {
                            Log::error('Mismatch between ITEM and CODE in XML.');
                            return redirect()->route('qr.generate')->with('error', 'Jumlah <ITEM> dan <CODE> tidak sesuai!');
                        }
                    } else {
                        Log::error('Invalid XML file.');
                        return redirect()->route('qr.generate')->with('error', 'File XML tidak valid!');
                    }
                } else {
                    Log::error('Uploaded file is not XML.');
                    return redirect()->route('qr.generate')->with('error', 'File harus berformat .xml!');
                }
            }

            return redirect()->route('qr.generate')->with('url', $url);
        }

        $url = $request->session()->get('url');
        $qrCodesFromXml = $request->session()->get('qr_codes_from_xml');

        Log::info('Rendering QR view with URL: ' . ($url ?? 'none') . ', XML codes: ' . ($qrCodesFromXml ? count($qrCodesFromXml) : 0));

        return view('qr', compact('url', 'qrCodesFromXml'));
    }

    public function saveSelected(Request $request)
    {
        $selectedUrls = $request->input('selected_urls', []);
        $successCount = 0;

        foreach ($selectedUrls as $url) {
            if (!QrCode::where('url', $url)->exists()) {
                QrCode::create(['url' => $url]);
                Log::info('QR Code saved: ' . $url);
                $successCount++;
            }
        }

        $request->session()->forget('qr_codes_from_xml');
        Log::info('QR codes from XML cleared after saving.');
        Cache::forget('qr_codes_list'); // Clear cache after saving
        return redirect()->route('qr.index')->with('success', "$successCount QR codes berhasil disimpan ke database!");
    }

    public function index()
    {
        $qrCodes = Cache::remember('qr_codes_list', 60, function () {
            return QrCode::all();
        });
        Log::info('Fetching QR code list: ' . $qrCodes->count() . ' items');
        return view('qr_list', compact('qrCodes'));
    }

    public function edit($id)
    {
        try {
            $qrCode = QrCode::findOrFail($id);
            Log::info('Editing QR code ID: ' . $id);
            return view('qr_edit', compact('qrCode'));
        } catch (\Exception $e) {
            Log::error('Failed to find QR code for editing: ' . $e->getMessage());
            return redirect()->route('qr.index')->with('error', 'QR Code tidak ditemukan!');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'url' => 'required|string|max:255|unique:qr_codes,url,' . $id,
            ]);
            $qrCode = QrCode::findOrFail($id);
            $qrCode->update(['url' => $request->url]);
            Log::info('QR code updated: ' . $request->url);
            Cache::forget('qr_codes_list');
            return redirect()->route('qr.index')->with('success', 'QR Code berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Failed to update QR code: ' . $e->getMessage());
            return redirect()->route('qr.index')->with('error', 'Gagal memperbarui QR Code!');
        }
    }

    public function destroy($id)
    {
        try {
            $qrCode = QrCode::findOrFail($id);
            $qrCode->delete();
            Log::info('QR code deleted: ' . $id);
            Cache::forget('qr_codes_list');
            return redirect()->route('qr.index')->with('success', 'QR Code berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Failed to delete QR code: ' . $e->getMessage());
            return redirect()->route('qr.index')->with('error', 'Gagal menghapus QR Code!');
        }
    }

    public function save(Request $request)
    {
        $request->validate([
            'url' => 'required|string|max:255|unique:qr_codes,url',
        ]);
        $url = $request->input('url');
        QrCode::create(['url' => $url]);
        Log::info('QR Code saved to database: ' . $url . ' at ' . now());
        Cache::forget('qr_codes_list'); // Clear cache after saving
        return redirect()->route('qr.index')->with('success', 'QR Code berhasil disimpan ke database!');
    }

    public function clean(Request $request)
    {
        $request->session()->forget('url');
        $request->session()->forget('qr_codes_from_xml');
        Log::info('All data cleared manually.');
        return redirect()->route('qr.generate')->with('success', 'Semua data telah dibersihkan!');
    }
}