<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f3f3f3;
        }

        .sidebar {
            width: 220px;
            background-color: #111;
            color: white;
            height: 100vh;
            padding-top: 20px;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            width: 100%;
        }

        .container {
            max-width: 600px;
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

        form label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        form button {
            margin-top: 20px;
            padding: 10px 20px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .preview-ttd {
            margin-top: 10px;
        }

        .preview-ttd img {
            max-width: 200px;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .text-red {
            color: red;
            margin-top: 6px;
        }
    </style>
</head>
<body>
    @include('components.sidebar')

    <div class="main-content">
        <div class="container">
            <h1>Edit Petugas</h1>

            <form action="{{ route('petugas.update', $petugas->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="nama">Nama</label>
                <input type="text" name="nama" value="{{ $petugas->nama }}" required>

                <label for="nik">NIK</label>
                <input type="text" name="nik" value="{{ $petugas->nik }}" required>

                <label for="ttd">Tanda Tangan (TTD)</label>
                <input type="file" name="ttd">

                <div class="preview-ttd">
                    @if ($petugas->ttd && file_exists(public_path('storage/' . $petugas->ttd)))
                        <img src="{{ asset('storage/' . $petugas->ttd) }}" alt="TTD {{ $petugas->nama }}">
                    @else
                        <p class="text-red">TTD belum tersedia atau file tidak ditemukan.</p>
                    @endif
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-green">Simpan</button>
                    <a href="{{ route('petugas.index') }}" class="btn-primary" style="text-decoration: none; padding: 10px 20px;">← Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
