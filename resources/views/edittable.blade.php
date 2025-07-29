<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita Acara Shift</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
        }
        .sidebar {
            position: fixed;
            left: 0; top: 0; bottom: 0;
            width: 240px;
            background-color: #1d3557;
            color: white;
            padding: 20px;
            overflow-y: auto;
        }
        .main-content {
            margin-left: 240px;
            padding: 30px;
        }
        h1 {
            color: #1d3557;
            text-align: center;
            margin-bottom: 25px;
        }
        form {
            max-width: 960px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        label {
            font-weight: 600;
            margin-top: 15px;
            display: block;
            color: #1f2937;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            resize: vertical;
            font-size: 14px;
            transition: 0.3s;
        }
        input:focus, textarea:focus {
            border-color: #0d6efd;
            outline: none;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.2);
        }
        textarea { height: 80px; }
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        button {
            background-color: #0d6efd;
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 30px;
            font-size: 16px;
            width: 100%;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #094cba;
        }
        @media screen and (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; padding: 15px; }
            form { padding: 20px; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    @include('components.sidebar')
</div>

      <div id="jam" style="position: absolute; top: 20px; right: 30px; font-size: 14px; color: #555; z-index: 9999;"></div>
      <div id="jam"></div>

<div class="main-content">
    <h1>📝 Edit Data Berita Acara Shift</h1>

    <form action="{{ route('beritaacara.update', $beritaAcara->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div>
                <label for="lama_nama">👤 Petugas Lama</label>
                <input type="text" id="lama_nama" name="lama_nama" value="{{ $beritaAcara->lama_nama }}" required>
            </div>
            <div>
                <label for="lama_nik">🆔 NIK Lama</label>
                <input type="text" id="lama_nik" name="lama_nik" value="{{ $beritaAcara->lama_nik }}" required>
            </div>
            <div>
                <label for="baru_nama">👤 Petugas Baru</label>
                <input type="text" id="baru_nama" name="baru_nama" value="{{ $beritaAcara->baru_nama }}" required>
            </div>
            <div>
                <label for="baru_nik">🆔 NIK Baru</label>
                <input type="text" id="baru_nik" name="baru_nik" value="{{ $beritaAcara->baru_nik }}" required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="lama_shift">⏰ Shift</label>
                <input type="text" id="lama_shift" name="lama_shift" value="{{ $beritaAcara->lama_shift }}" required>
            </div>
            <div>
                <label for="tiket">🎫 No Tiket</label>
                <textarea name="tiket" id="tiket">{{ $beritaAcara->tiket }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="sangfor">🛡️ Sangfor (SOAR)</label>
                <textarea name="sangfor" id="sangfor">{{ $beritaAcara->sangfor }}</textarea>
            </div>
            <div>
                <label for="jtn">🛡️ FortiJTN</label>
                <textarea name="jtn" id="jtn">{{ $beritaAcara->jtn }}</textarea>
            </div>
            <div>
                <label for="web">🛡️ FortiWeb</label>
                <textarea name="web" id="web">{{ $beritaAcara->web }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="checkpoint">🛡️ Checkpoint</label>
                <textarea name="checkpoint" id="checkpoint">{{ $beritaAcara->checkpoint }}</textarea>
            </div>
            <div>
                <label for="sophos_ip">🌐 Sophos IP</label>
                <textarea name="sophos_ip" id="sophos_ip">{{ $beritaAcara->sophos_ip }}</textarea>
            </div>
            <div>
                <label for="sophos_url">🔗 Sophos URL</label>
                <textarea name="sophos_url" id="sophos_url">{{ $beritaAcara->sophos_url }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="vpn">🔐 VPN</label>
                <textarea name="vpn" id="vpn">{{ $beritaAcara->vpn }}</textarea>
            </div>
            <div>
                <label for="edr">🧠 EDR</label>
                <textarea name="edr" id="edr">{{ $beritaAcara->edr }}</textarea>
            </div>
            <div>
                <label for="daily_report">📄 Daily Report Magnus</label>
                <textarea name="daily_report" id="daily_report">{{ $beritaAcara->daily_report }}</textarea>
            </div>
        </div>

        <button type="submit">💾 Simpan Perubahan</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function updateJam() {
        const jamElement = document.getElementById('jam');
        const now = new Date();

        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        const tanggal = now.toLocaleDateString('id-ID', options);
        const waktu = now.toLocaleTimeString('id-ID');

        jamElement.textContent = `${tanggal} - ${waktu}`;
    }

    setInterval(updateJam, 1000);
    updateJam(); // pertama kali
});
</script>

</body>
</html>
