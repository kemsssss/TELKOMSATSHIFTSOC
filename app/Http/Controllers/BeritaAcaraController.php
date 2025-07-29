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
            'petugas_lama_id' => 'required|exists:petugas,id',
            'petugas_baru_id' => 'required|exists:petugas,id',
            'shift' => 'required',
            'tanggal_shift' => 'required|date',
        ]);

        $petugasLama = Petugas::findOrFail($validated['petugas_lama_id']);
        $petugasBaru = Petugas::findOrFail($validated['petugas_baru_id']);

        $lama_ttd = $this->getBase64FromStorage($petugasLama->ttd);
        $baru_ttd = $this->getBase64FromStorage($petugasBaru->ttd);
        $logo = $this->getBase64FromStorage('logotelkomsat/Logo-Telkomsat.png');

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
            'sophos_ip'    => implode("\n", $request->input('sophos_ip', [])),
            'sophos_url'   => implode("\n", $request->input('sophos_url', [])),
            'vpn'          => implode("\n", $request->input('vpn', [])),
            'edr'          => implode("\n", $request->input('edr', [])),
            'daily_report' => implode("\n", $request->input('magnus', [])),
        ]);

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

    public function index()
    {
        $beritaAcaras = BeritaAcara::all();
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

    $beritaAcara->update([
        'tiket'        => $validated['tiket'] ?? '',
        'sangfor'      => $validated['sangfor'] ?? '',
        'jtn'          => $validated['jtn'] ?? '',
        'web'          => $validated['web'] ?? '',
        'checkpoint'   => $validated['checkpoint'] ?? '',
        'sophos_ip'    => $validated['sophos_ip'] ?? '',
        'sophos_url'   => $validated['sophos_url'] ?? '',
        'vpn'          => $validated['vpn'] ?? '',
        'edr'          => $validated['edr'] ?? '',
        'daily_report' => $validated['daily_report'] ?? '',
    ]);

    return redirect()->route('table')->with('success', 'Data Berita Acara berhasil diperbarui.');
}



    public function destroy($id)
    {
        $beritaAcara = BeritaAcara::findOrFail($id);
        $beritaAcara->delete();
        return redirect()->route('table')->with('success', 'Data berhasil dihapus.');
    }
}
