<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }

        .form-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
            justify-content: space-between;
        }

        .form-bar form {
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 200px;
        }

        .btn {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .btn-yellow {
            background-color: #ffc107;
            color: #333;
        }

        .btn-yellow:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fdfdfd;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 16px;
        }

        .card img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 10px;
        }

        .alert {
            padding: 12px;
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .actions {
            margin-top: 12px;
            display: flex;
            gap: 10px;
        }

        .no-data {
            text-align: center;
            color: #999;
            padding: 50px;
            grid-column: 1 / -1;
        }

        @media (max-width: 500px) {
            .form-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            input[type="text"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <header>
            <h1>Daftar Petugas</h1>
        </header>

        <section class="form-bar">
            <form method="GET" action="{{ route('petugas.index') }}">
                <input type="text" name="cari" placeholder="Cari nama atau NIK" value="{{ request('cari') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>

            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="{{ route('welcome') }}" class="btn btn-primary">← Kembali ke Beranda</a>
                <a href="{{ route('petugas.create') }}" class="btn btn-green">+ Tambah Petugas</a>
            </div>
        </section>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <section class="card-grid">
            @forelse ($petugas as $p)
                <div class="card">
                    <p><strong>Nama:</strong> {{ $p->nama }}</p>
                    <p><strong>NIK:</strong> {{ $p->nik }}</p>

                    @if ($p->ttd && file_exists(public_path('storage/' . $p->ttd)))
                        <img src="{{ asset('storage/' . $p->ttd) }}" alt="TTD {{ $p->nama }}">
                    @else
                        <p class="text-red">TTD belum tersedia atau file tidak ditemukan.</p>
                    @endif

                    <div class="actions">
                        <a href="{{ route('petugas.edit', $p->id) }}" class="btn btn-yellow">Edit</a>
                        <form action="{{ route('petugas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="no-data">Tidak ada data petugas.</div>
            @endforelse
        </section>
    </div>

</body>
</html>
