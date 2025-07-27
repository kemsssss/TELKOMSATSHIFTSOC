<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\BeritaAcara;
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

        // Ambil logo Telkomsat dari storage dan ubah ke base64
        $logoPath = public_path('storage/logotelkomsat/Logo-Telkomsat.png');
        $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : '';

        // Simpan ke database (opsional logo_path)
        BeritaAcara::create([
            'lama_nama'      => $petugasLama->nama,
            'lama_nik'       => $petugasLama->nik,
            'lama_shift'     => $request->input('shift'),
        
            'baru_nama'      => $petugasBaru->nama,
            'baru_nik'       => $petugasBaru->nik,
            'baru_shift'     => $request->input('shift'),
        
            'tiket'          => $request->input('tiket_nomor'),
            'sangfor'        => $request->input('soar_sangfor'),
            'jtn'            => $request->input('soar_fortijtn'),
            'web'            => $request->input('soar_fortiweb'),
            'checkpoint'     => $request->input('soar_checkpoint'),
        
            'sophos_ip'      => is_array($request->input('sophos_ip')) ? implode(',', $request->input('sophos_ip')) : '',
            'sophos_url'     => is_array($request->input('sophos_url')) ? implode(',', $request->input('sophos_url')) : '',
            'vpn'            => is_array($request->input('vpn')) ? implode(',', $request->input('vpn')) : '',
            'edr'            => is_array($request->input('edr')) ? implode(',', $request->input('edr')) : '',
            'daily_report'   => is_array($request->input('magnus')) ? implode(',', $request->input('magnus')) : '',

            // (Opsional)
            // 'logo_path'   => 'storage/logotelkomsat/Logo-Telkomsat.png',
        ]);
        
        // Data untuk PDF
        $data = [
            'petugas_lama' => $petugasLama,
            'petugas_baru' => $petugasBaru,
            'shift' => $request->input('shift'),
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

            // 🆕 Logo Telkomsat (base64)
            'logo' => $logoBase64,
        ];

        return Pdf::loadView('berita-acara', $data)->stream('serah terima shift SOC.pdf');
    }

    public function getPetugas($id)
    {
        $petugas = Petugas::findOrFail($id);

        return response()->json([
            'nama' => $petugas->nama,
            'nik' => $petugas->nik,
            'ttd' => $petugas->ttd,
        ]);
    }
}
