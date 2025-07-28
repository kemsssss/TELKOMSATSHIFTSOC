<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Petugas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

    <h1 class="text-2xl font-bold mb-4">Daftar Petugas</h1>

<a href="{{ route('petugas.create') }}"
   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-4">
   + Tambah Petugas
</a>


    @if (session('success'))
        <div class="bg-green-200 text-green-800 p-2 mt-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
        @foreach ($petugas as $p)
            <div class="bg-white p-4 rounded shadow">
                <p><strong>Nama:</strong> {{ $p->nama }}</p>
                <p><strong>NIK:</strong> {{ $p->nik }}</p>
                <p><strong>TTD:</strong></p>
                <img src="{{ asset('storage/' . $p->ttd) }}" alt="TTD" class="mt-2 border w-48">
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('petugas.edit', $p->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                    <form action="{{ route('petugas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
