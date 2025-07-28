<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
            margin-right: 10px;
            display: inline-block;
            text-decoration: none;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        img {
            max-width: 150px;
            height: auto;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Data Petugas</h1>

        <form action="{{ route('petugas.update', $petugas->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="nama">Nama Petugas:</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $petugas->nama) }}" required>

            <label for="nik">NIK:</label>
            <input type="text" name="nik" id="nik" value="{{ old('nik', $petugas->nik) }}" required>

            <label for="ttd">Upload TTD (jika ingin mengganti):</label>
            <input type="file" name="ttd" id="ttd" accept="image/*">

            @if ($petugas->ttd && file_exists(public_path('storage/' . $petugas->ttd)))
                <p>TTD saat ini:</p>
                <img src="{{ asset('storage/' . $petugas->ttd) }}" alt="TTD {{ $petugas->nama }}">
            @endif

            <br>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('petugas.index') }}" class="btn btn-primary">← Kembali</a>
        </form>
    </div>

</body>
</html>
