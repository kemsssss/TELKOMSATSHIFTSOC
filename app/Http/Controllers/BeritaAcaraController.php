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
        // Validasi input dasar
        $validated = $request->validate([
            'petugas_lama_id' => 'required|exists:petugas,id',
            'petugas_baru_id' => 'required|exists:petugas,id',
        ]);

        // Ambil data petugas lama & baru
        $petugasLama = Petugas::findOrFail($validated['petugas_lama_id']);
        $petugasBaru = Petugas::findOrFail($validated['petugas_baru_id']);

        // Ambil path tanda tangan
        $lamaTtdPath = public_path($petugasLama->ttd ?? '');
        $baruTtdPath = public_path($petugasBaru->ttd ?? '');

        // Konversi tanda tangan ke base64
        $lama_ttd = file_exists($lamaTtdPath) ? base64_encode(file_get_contents($lamaTtdPath)) : '';
        $baru_ttd = file_exists($baruTtdPath) ? base64_encode(file_get_contents($baruTtdPath)) : '';

        // Ambil data isian tambahan
        $data = [
            'petugas_lama' => $petugasLama,
            'petugas_baru' => $petugasBaru,
            'lama_ttd' => $lama_ttd,
            'baru_ttd' => $baru_ttd,
            'tanggal_shift' => $request->input('tanggal_shift'),
            'tiket_nomor' => $request->input('tiket_nomor'),
                'sangfor'     => $request->input('soar_sangfor'),
                'fortijtn'    => $request->input('soar_fortijtn'),
                'fortiweb'    => $request->input('soar_fortiweb'),
                'checkpoint'  => $request->input('soar_checkpoint'),
                'sophos_ip'  => is_array($request->input('sophos_ip'))  ? $request->input('sophos_ip')  : [],
                'sophos_url' => is_array($request->input('sophos_url')) ? $request->input('sophos_url') : [],
                'vpn'        => is_array($request->input('vpn'))        ? $request->input('vpn')        : [],
                'edr'        => is_array($request->input('edr'))        ? $request->input('edr')        : [],
                'magnus'     => is_array($request->input('magnus'))     ? $request->input('magnus')     : [],
        ];
    

        return Pdf::loadView('berita-acara', $data)->stream('Serah Terima Shift SOC Telkomsat.pdf');
    }
}
