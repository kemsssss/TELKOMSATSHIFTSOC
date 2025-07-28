<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        // Validasi input
        $validated = $request->validate([
            'petugas_lama_id' => 'required|exists:petugas,id',
            'petugas_baru_id' => 'required|exists:petugas,id',
            'shift' => 'required',
            'tanggal_shift' => 'required|date',
        ]);

        // Ambil data petugas
        $petugasLama = Petugas::findOrFail($validated['petugas_lama_id']);
        $petugasBaru = Petugas::findOrFail($validated['petugas_baru_id']);

        // Base64 tanda tangan
        $lama_ttd = $this->getBase64FromStorage($petugasLama->ttd);
        $baru_ttd = $this->getBase64FromStorage($petugasBaru->ttd);

        // Base64 logo
        $logo = $this->getBase64FromStorage('logotelkomsat/Logo-Telkomsat.png');

        // Simpan ke database
        BeritaAcara::create([
            'lama_nama'    => $petugasLama->nama,
            'lama_nik'     => $petugasLama->nik,
            'lama_shift'   => $request->input('shift'),
            'baru_nama'    => $petugasBaru->nama,
            'baru_nik'     => $petugasBaru->nik,
            'baru_shift'   => $request->input('shift'),
            'tiket'        => $request->input('tiket_nomor'),
            'sangfor'      => $request->input('soar_sangfor'),
            'jtn'          => $request->input('soar_fortijtn'),
            'web'          => $request->input('soar_fortiweb'),
            'checkpoint'   => $request->input('soar_checkpoint'),
            'sophos_ip'    => implode(',', $request->input('sophos_ip', [])),
            'sophos_url'   => implode(',', $request->input('sophos_url', [])),
            'vpn'          => implode(',', $request->input('vpn', [])),
            'edr'          => implode(',', $request->input('edr', [])),
            'daily_report' => implode(',', $request->input('magnus', [])),
        ]);

        // Data PDF
        $data = [
            'petugas_lama'   => $petugasLama,
            'petugas_baru'   => $petugasBaru,
            'shift'          => $request->input('shift'),
            'tanggal_shift'  => $request->input('tanggal_shift'),
            'tiket_nomor'    => $request->input('tiket_nomor'),
            'sangfor'        => $request->input('soar_sangfor'),
            'fortijtn'       => $request->input('soar_fortijtn'),
            'fortiweb'       => $request->input('soar_fortiweb'),
            'checkpoint'     => $request->input('soar_checkpoint'),
            'sophos_ip'      => $request->input('sophos_ip', []),
            'sophos_url'     => $request->input('sophos_url', []),
            'vpn'            => $request->input('vpn', []),
            'edr'            => $request->input('edr', []),
            'magnus'         => $request->input('magnus', []),
            'lama_ttd'       => $lama_ttd,
            'baru_ttd'       => $baru_ttd,
            'logo'           => $logo,
        ];

        return Pdf::loadView('berita-acara', $data)->stream('serah-terima-shift-SOC.pdf');
    }

    private function getBase64FromStorage($relativePath)
    {
        if (!$relativePath) return '';

        if (Storage::disk('public')->exists($relativePath)) {
            $path = Storage::disk('public')->path($relativePath);
            $mime = mime_content_type($path);
            $base64 = base64_encode(file_get_contents($path));
            return "data:{$mime};base64,{$base64}";
        }

        return '';
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
