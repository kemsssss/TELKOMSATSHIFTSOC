<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BeritaAcaraController extends Controller
{
    public function showForm()
    {
        $petugas = Petugas::all();
        return view('welcome', compact('petugas'));
    }

    public function cetakPDF(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'petugas_lama_id' => 'required|exists:petugas,id',
            'petugas_baru_id' => 'required|exists:petugas,id',
        ]);

        $petugasLama = Petugas::findOrFail($request->petugas_lama_id);
        $petugasBaru = Petugas::findOrFail($request->petugas_baru_id);

        // Handle TTD sebagai gambar base64 (jika disimpan dalam storage/public)
        $lamaTtdPath = public_path($petugasLama->ttd ?? '');
        $baruTtdPath = public_path($petugasBaru->ttd ?? '');

        $lama_ttd = file_exists($lamaTtdPath) ? base64_encode(file_get_contents($lamaTtdPath)) : null;
        $baru_ttd = file_exists($baruTtdPath) ? base64_encode(file_get_contents($baruTtdPath)) : null;

        // Ambil data tambahan dari form
        $data = [
            'petugas_lama' => $petugasLama,
            'petugas_baru' => $petugasBaru,
            'lama_ttd' => $lama_ttd,
            'baru_ttd' => $baru_ttd,
            'tanggal_shift' => $request->input('tanggal_shift'),
            'tiket_nomor' => $request->input('tiket_nomor'),

            // Auto Blocking SOAR
            'soar' => [
                'sangfor' => $request->input('soar_sangfor'),
                'fortijtn' => $request->input('soar_fortijtn'),
                'fortiweb' => $request->input('soar_fortiweb'),
                'checkpoint' => $request->input('soar_checkpoint'),
            ],

            // Manual Blocking dan Follow-up
            'manual' => [
                'sophos_ip' => $request->input('sophos_ip', []),
                'sophos_url' => $request->input('sophos_url', []),
                'vpn' => $request->input('vpn', []),
                'edr' => $request->input('edr', []),
                'magnus' => $request->input('magnus', []),
            ],
        ];

        return Pdf::loadView('berita-acara', $data)->stream('berita-acara.pdf');
    }
}
