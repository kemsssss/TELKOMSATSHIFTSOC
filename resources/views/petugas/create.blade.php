<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Petugas</title>
    <style>
        body {
            background: linear-gradient(to bottom right, #e0f2ff, #ffffff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background: #fff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border: 1px solid #e0e0e0;
        }

        h1 {
            text-align: center;
            color: #ff0000;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="file"]:focus {
            border-color: #3b82f6;
            outline: none;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-back {
            background-color: #e5e7eb;
            color: #333;
        }

        .btn-back:hover {
            background-color: #d1d5db;
        }

        .btn-submit {
            background-color: #2563eb;
            color: #fff;
            border: none;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        .error-box {
            background: #fee2e2;
            color: #b91c1c;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #fecaca;
            margin-bottom: 20px;
        }

        #ttd-preview {
            max-height: 200px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Tambah Petugas</h1>

    @if ($errors->any())
        <div class="error-box">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="nama">Nama Petugas</label>
        <input type="text" name="nama" id="nama" placeholder="Contoh: Budi Santoso" value="{{ old('nama') }}" required>

        <label for="nik">NIK</label>
        <input type="text" name="nik" id="nik" placeholder="Contoh: 1234567890123456" value="{{ old('nik') }}" required>

        <label for="ttd">Tanda Tangan</label>
        <input type="file" name="ttd" id="ttd" accept="image/*" onchange="previewTTD(event)" required>

        <img id="ttd-preview" alt="Preview Tanda Tangan">

        <div class="buttons">
            <a href="{{ route('petugas.index') }}" class="btn btn-back">← Kembali</a>
            <button type="submit" class="btn btn-submit">Simpan Petugas</button>
        </div>
    </form>
</div>

<script>
    function previewTTD(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('ttd-preview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
