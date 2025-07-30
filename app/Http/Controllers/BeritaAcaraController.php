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
    $validated = $request->validate([
        'petugas_lama'    => 'required|array|min:1',
        'petugas_lama.*'  => 'exists:petugas,id',
        'petugas_baru'    => 'required|array|min:1',
        'petugas_baru.*'  => 'exists:petugas,id',
        'lama_shift'      => 'required|string',
        'baru_shift'      => 'required|string',
        'tanggal_shift'   => 'required|date',
    ]);

    $petugasLama = Petugas::whereIn('id', $validated['petugas_lama'])->get();
    $petugasBaru = Petugas::whereIn('id', $validated['petugas_baru'])->get();

    // Ambil ID terakhir yg dipilih
    $lastPetugasLamaId = end($validated['petugas_lama']);
    $lastPetugasBaruId = end($validated['petugas_baru']);

    // Temukan petugas berdasarkan ID
    $lastPetugasLama = $petugasLama->firstWhere('id', $lastPetugasLamaId);
    $lastPetugasBaru = $petugasBaru->firstWhere('id', $lastPetugasBaruId);

    // TTD
    $lama_ttd = $lastPetugasLama && $lastPetugasLama->ttd ? $this->getBase64FromStorage($lastPetugasLama->ttd) : null;
    $baru_ttd = $lastPetugasBaru && $lastPetugasBaru->ttd ? $this->getBase64FromStorage($lastPetugasBaru->ttd) : null;

    // Logo
    $logo = $this->getBase64FromStorage('logotelkomsat/Logo-Telkomsat.png');

    // Simpan ke DB
    $beritaAcara = BeritaAcara::create([
        'lama_shift'     => $validated['lama_shift'],
        'baru_shift'     => $validated['baru_shift'],
        'tanggal_shift'  => $validated['tanggal_shift'],
        'tiket'          => $request->input('tiket_nomor'),
        'sangfor'        => $request->input('soar_sangfor'),
        'jtn'            => $request->input('soar_fortijtn'),
        'web'            => $request->input('soar_fortiweb'),
        'checkpoint'     => $request->input('soar_checkpoint'),
        'sophos_ip'      => implode("\n", $request->input('sophos_ip', [])),
        'sophos_url'     => implode("\n", $request->input('sophos_url', [])),
        'vpn'            => implode("\n", $request->input('vpn', [])),
        'edr'            => implode("\n", $request->input('edr', [])),
        'daily_report'   => implode("\n", $request->input('magnus', [])),
    ]);

    $beritaAcara->petugasLama()->attach($validated['petugas_lama']);
    $beritaAcara->petugasBaru()->attach($validated['petugas_baru']);

    // Data untuk PDF
    $data = [
        'petugas_lama'   => $petugasLama,
        'petugas_baru'   => $petugasBaru,
        'lama_shift'     => $validated['lama_shift'],
        'baru_shift'     => $validated['baru_shift'],
        'tanggal_shift'  => $validated['tanggal_shift'],
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
        'lama_nama'      => $lastPetugasLama->nama ?? '-',
        'lama_nik'       => $lastPetugasLama->nik ?? '-',
        'baru_nama'      => $lastPetugasBaru->nama ?? '-',
        'baru_nik'       => $lastPetugasBaru->nik ?? '-',
        'logo'           => $logo,
    ];

    return Pdf::loadView('berita-acara', $data)->stream('serah-terima-shift-SOC.pdf');
}






    public function print($id)
    {
        $beritaAcara = BeritaAcara::with(['petugasLama', 'petugasBaru'])->findOrFail($id);

        // Ambil data petugas berdasarkan nama (jika tidak ada relasi langsung ID -> model Petugas)
$petugas_lama = $beritaAcara->petugasLama;
$petugas_baru = $beritaAcara->petugasBaru;
 

$data = [
    'beritaAcara'  => $beritaAcara,
    'petugas_lama' => $petugas_lama,
    'petugas_baru' => $petugas_baru,
    'lama_ttd'     => $this->getBase64FromStorage($petugas_lama[0]->ttd ?? null),
    'baru_ttd'     => $this->getBase64FromStorage($petugas_baru[0]->ttd ?? null),
];

        return Pdf::loadView('berita-acara', $data)->stream('Serah Terima Shift SOC.pdf');
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

    public function index()
    {
        $beritaAcaras = BeritaAcara::with(['petugasLama', 'petugasBaru'])->get();
        return view('table', compact('beritaAcaras'));
    }

    public function edit($id)
    {
        $beritaAcara = BeritaAcara::findOrFail($id);
        return view('edittable', compact('beritaAcara'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tiket'        => 'nullable|string',
            'sangfor'      => 'nullable|string',
            'jtn'          => 'nullable|string',
            'web'          => 'nullable|string',
            'checkpoint'   => 'nullable|string',
            'sophos_ip'    => 'nullable|string',
            'sophos_url'   => 'nullable|string',
            'vpn'          => 'nullable|string',
            'edr'          => 'nullable|string',
            'daily_report' => 'nullable|string',
        ]);

        $beritaAcara = BeritaAcara::findOrFail($id);
        $beritaAcara->update($validated);

        return redirect()->route('table')->with('success', 'Data Berita Acara berhasil diperbarui.');
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
}
