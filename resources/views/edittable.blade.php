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
        }
        label {
            font-weight: 600;
            margin-top: 15px;
            display: block;
            color: #1f2937;
        }
        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            resize: vertical;
            font-size: 14px;
        }
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .multi-input {
            margin-bottom: 10px;
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
        }
        button:hover {
            background-color: #094cba;
        }
        .btn-tambah {
            background: #10b981;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    @include('components.sidebar')
</div>

<div id="jam" style="position: absolute; top: 20px; right: 30px; font-size: 14px; color: #555; z-index: 9999;"></div>

<div class="main-content">
    <h1>📜 Edit Data Berita Acara Shift</h1>

    <form action="{{ route('beritaacara.update', $beritaAcara->id) }}" method="POST">
        @csrf
        @method('PUT')

<div class="mb-3">
  <label for="tanggal" class="form-label">Tanggal</label>
  <input type="date" class="form-control" id="tanggal" name="tanggal"
  value="{{ old('tanggal', \Carbon\Carbon::parse($beritaAcara->tanggal)->format('Y-m-d')) }}">

</div>


        <hr><h3>Petugas Lama</h3>
        <div id="petugasLamaContainer">
            @foreach ($beritaAcara->petugasLama as $petugas)
                <div class="form-row multi-input">
                    <input type="text" name="nama_lama[]" value="{{ $petugas->nama }}" placeholder="Nama Petugas Lama" required>
                    <input type="text" name="nik_lama[]" value="{{ $petugas->nik }}" placeholder="NIK Lama" required>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn-tambah" onclick="tambahPetugas('Lama')">+ Tambah Petugas Lama</button>

        <label for="lama_shift">⏰ Shift Petugas Lama</label>
        <input type="text" id="lama_shift" name="lama_shift" value="{{ $beritaAcara->lama_shift }}" required>

        <hr><h3>Petugas Baru</h3>
        <div id="petugasBaruContainer">
            @foreach ($beritaAcara->petugasBaru as $petugas)
                <div class="form-row multi-input">
                    <input type="text" name="nama_baru[]" value="{{ $petugas->nama }}" placeholder="Nama Petugas Baru" required>
                    <input type="text" name="nik_baru[]" value="{{ $petugas->nik }}" placeholder="NIK Baru" required>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn-tambah" onclick="tambahPetugas('Baru')">+ Tambah Petugas Baru</button>

        <label for="baru_shift">⏰ Shift Petugas Baru</label>
        <input type="text" id="baru_shift" name="baru_shift" value="{{ $beritaAcara->baru_shift }}" required>

        <label for="tiket">🎫 No Tiket</label>
        <textarea name="tiket" id="tiket">{{ $beritaAcara->tiket }}</textarea>

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
function tambahPetugas(tipe) {
    const container = document.getElementById(`petugas${tipe}Container`);
    const div = document.createElement('div');
    div.classList.add('form-row', 'multi-input');
    div.innerHTML = `
        <input type="text" name="nama_${tipe.toLowerCase()}[]" placeholder="Nama Petugas ${tipe}" required>
        <input type="text" name="nik_${tipe.toLowerCase()}[]" placeholder="NIK ${tipe}" required>
    `;
    container.appendChild(div);
}

function updateJam() {
    const jamElement = document.getElementById('jam');
    const now = new Date();
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    const tanggal = now.toLocaleDateString('id-ID', options);
    const waktu = now.toLocaleTimeString('id-ID');
    jamElement.textContent = `${tanggal} - ${waktu}`;
}
setInterval(updateJam, 1000);
updateJam();
</script>

</body>
</html>
