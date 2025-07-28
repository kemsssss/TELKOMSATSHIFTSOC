<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-10 px-4">

    <div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-6">Tambah Petugas</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="nama" class="block font-medium">Nama</label>
                <input type="text" name="nama" id="nama"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1"
                    value="{{ old('nama') }}" required>
            </div>

            <div class="mb-4">
                <label for="nik" class="block font-medium">NIK</label>
                <input type="text" name="nik" id="nik"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1"
                    value="{{ old('nik') }}" required>
            </div>

            <div class="mb-4">
                <label for="ttd" class="block font-medium">Tanda Tangan</label>
                <input type="file" name="ttd" id="ttd"
                    accept="image/*"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('petugas.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Kembali
                </a>

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
