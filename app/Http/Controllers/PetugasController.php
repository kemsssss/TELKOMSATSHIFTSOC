<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $query = Petugas::query();

        if ($request->has('cari')) {
            $search = $request->input('cari');
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nik', 'like', '%' . $search . '%');
        }

        $petugas = $query->latest()->get();

        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        Log::info('PetugasController@store terpanggil');
        Log::info('Request all (kecuali file):', $request->except(['_token', 'ttd']));

        $request->validate([
            'nama' => 'required',
            'nik' => 'nullable|unique:petugas,nik',
            'ttd' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        Log::info('Lolos validasi');

        $ttdPath = null;

        try {
            if ($request->hasFile('ttd')) {
                $file = $request->file('ttd');

                Log::info('📝 Nama file: ' . $file->getClientOriginalName());
                Log::info('📝 Ukuran file: ' . $file->getSize());
                Log::info('📝 Apakah valid upload: ' . ($file->isValid() ? 'ya' : 'tidak'));

                if ($file->isValid()) {
                    $originalName = preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $filename = time() . '_' . $originalName;
                    Storage::disk('public')->makeDirectory('ttd');
                    $destination = storage_path('app/public/ttd/' . $filename);
$success = $file->move(dirname($destination), basename($destination));
Log::info('📂 Hasil move(): ' . var_export($success, true));

if ($success) {
    $ttdPath = 'ttd/' . $filename;
} else {
    Log::error('❌ move() gagal');
}

Log::info('📦 Nilai storeAs(): ' . var_export($ttdPath, true));
Log::info('📂 Izin folder storage: ' . substr(sprintf('%o', fileperms(storage_path('app/public/ttd'))), -4));



                    if ($ttdPath) {
                        Log::info('✅ File berhasil disimpan. Path: ' . $ttdPath);
                    } else {
                        Log::error('❌ storeAs() tidak mengembalikan path');
                        return back()->withErrors(['ttd' => 'Gagal menyimpan file tanda tangan']);
                    }
                } else {
                    Log::error('❌ File upload tidak valid');
                    return back()->withErrors(['ttd' => 'File tanda tangan tidak valid']);
                }
            } else {
                Log::error('❌ Tidak ada file ttd di request');
                return back()->withErrors(['ttd' => 'File tanda tangan tidak ditemukan']);
            }
        } catch (\Exception $e) {
            Log::error('❌ Gagal menyimpan file: ' . $e->getMessage());
            return back()->withErrors(['ttd' => 'Gagal menyimpan file']);
        }

Petugas::create([
    'nama' => $request->nama,
    'nik' => $request->nik ?? '',
    'ttd_path' => $ttdPath,
]);


        Log::info('✅ Data petugas berhasil disimpan');

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'nik' => 'nullable|unique:petugas,nik,' . $id,
        'ttd' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
    ]);

    $data = [
        'nama' => $request->nama,
        'nik' => $request->nik ?? '',

    ];

    if ($request->hasFile('ttd')) {
        try {
            $file = $request->file('ttd');

            Log::info('📝 Update TTD - Nama file: ' . $file->getClientOriginalName());
            Log::info('📝 Update TTD - Ukuran file: ' . $file->getSize());

            if ($file->isValid()) {
                // Hapus file lama jika ada
                if ($petugas->ttd_path && Storage::disk('public')->exists($petugas->ttd_path)) {
                    Storage::disk('public')->delete($petugas->ttd_path);
                    Log::info('🗑️ File lama dihapus: ' . $petugas->ttd_path);
                }

                $originalName = preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $filename = time() . '_' . $originalName;
                Storage::disk('public')->makeDirectory('ttd');
                $destination = storage_path('app/public/ttd/' . $filename);

                $success = $file->move(dirname($destination), basename($destination));
                Log::info('📂 Hasil move(): ' . var_export($success, true));

                if ($success) {
                    $data['ttd_path'] = 'ttd/' . $filename;
                    Log::info('✅ File TTD berhasil diupdate. Path: ' . $data['ttd_path']);
                } else {
                    Log::error('❌ move() gagal saat update');
                    return back()->withErrors(['ttd' => 'Gagal menyimpan file tanda tangan saat update']);
                }
            } else {
                Log::error('❌ File TTD tidak valid saat update');
                return back()->withErrors(['ttd' => 'File tanda tangan tidak valid']);
            }
        } catch (\Exception $e) {
            Log::error('❌ Exception saat update TTD: ' . $e->getMessage());
            return back()->withErrors(['ttd' => 'Gagal menyimpan file tanda tangan']);
        }
    }

    $petugas->update($data);

    return redirect()->route('petugas.index')->with('success', 'Petugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);

        if ($petugas->ttd_path && Storage::disk('public')->exists($petugas->ttd_path)) {
            Storage::disk('public')->delete($petugas->ttd_path);
        }

        $petugas->delete();

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus.');
    }

    public function show($id)
    {
        $petugas = Petugas::findOrFail($id);

        return response()->json([
            'nama' => $petugas->nama,
            'nik' => $petugas->nik,
            'ttd' => $petugas->ttd_path,
        ]);
    }
}
