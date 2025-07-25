<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Berita Acara Shift SOC</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      font-size: 14px;
      color: #000;
    }

    .logo {
      text-align: center;
      margin-bottom: 10px;
    }

    .logo img {
      height: 70px;
    }

    h2 {
      text-align: center;
      font-size: 18px;
      text-transform: uppercase;
      margin-bottom: 20px;
    }

    .section {
      margin-bottom: 25px;
    }

    ul {
      margin-left: 20px;
    }

    .ttd-area {
      margin-top: 50px;
      display: flex;
      justify-content: space-between;
      text-align: center;
    }

    .ttd-area div {
      width: 45%;
    }

    .ttd-label {
      margin-top: 60px;
      text-decoration: underline;
      font-weight: bold;
    }

    @media print {
      body {
        margin: 10mm;
        font-size: 12px;
      }

      .no-print {
        display: none;
      }
    }
  </style>
</head>
<body>

  <div class="logo">
    <img src="{{ public_path('logo_telkomsat.png') }}" alt="Telkomsat Logo">
  </div>

  <h2>BERITA ACARA SERAH TERIMA SHIFT SOC <span style="color: red;">TELKOMSAT</span></h2>

  <div class="section">
    <p><strong>Yang bertanda tangan di bawah ini:</strong></p>
    <p>Nama: {{ $petugas_lama->nama }}</p>
    <p>NIK: {{ $petugas_lama->nik }}</p>
    <p>Shift: {{ $shift }}</p>

    <p><strong>Serah terima shift dengan:</strong></p>
    <p>Nama: {{ $petugas_baru->nama }}</p>
    <p>NIK: {{ $petugas_baru->nik }}</p>
    <p>Shift: {{ $shift }}</p>
  </div>

  <div class="section">
    <p>Pada hari <strong>{{ $tanggal_shift }}</strong>, dengan ini kami melakukan pergantian shift SOC dengan detail pekerjaan sebagai berikut:</p>

    <ol>
      <li>
        <strong>Tiket yang dibuat:</strong><br>
        {{ trim($tiket_nomor ?? '') !== '' ? $tiket_nomor : '-' }}
      </li>

      <li>
        <strong>Auto Blocking SOAR:</strong>
        <ul>
          <li>SangFOR = {{ trim($sangfor ?? '') !== '' ? $sangfor : '-' }}</li>
          <li>Forti-JTN = {{ trim($fortijtn ?? '') !== '' ? $fortijtn : '-' }}</li>
          <li>FortiWeb = {{ trim($fortiweb ?? '') !== '' ? $fortiweb : '-' }}</li>
          <li>CheckPoint = {{ trim($checkpoint ?? '') !== '' ? $checkpoint : '-' }}</li>
        </ul>
      </li>

      <li>
        <strong>Manual Blocking dan FollowUP:</strong>
        <ul>
          <li>Sophos IP = {{ !empty($sophos_ip) ? implode(', ', $sophos_ip) : '-' }}</li>
          <li>Sophos URL = {{ !empty($sophos_url) ? implode(', ', $sophos_url) : '-' }}</li>
          <li>VPN = {{ !empty($vpn) ? implode(', ', $vpn) : '-' }}</li>
          <li>EDR = {{ !empty($edr) ? implode(', ', $edr) : '-' }}</li>
          <li>Daily Report Magnus = {{ !empty($magnus) ? implode(', ', $magnus) : '-' }}</li>
        </ul>
      </li>
    </ol>
  </div>

  <div class="section">
    <p>Sekian telah kami laksanakan pekerjaan tersebut dengan baik. Demikian berita acara ini dibuat dengan sebaik-baiknya.</p>
  </div>

  <div class="ttd-area">
    <div>
      Petugas Lama<br><br><br>
      @if($lama_ttd)
        <img src="data:image/png;base64,{{ $lama_ttd }}" height="80" alt="TTD Lama"><br>
      @endif
      <div class="ttd-label">{{ $petugas_lama->nama }}<br>NIK: {{ $petugas_lama->nik }}</div>
    </div>

    <div>
      Petugas Baru<br><br><br>
      @if($baru_ttd)
        <img src="data:image/png;base64,{{ $baru_ttd }}" height="80" alt="TTD Baru"><br>
      @endif
      <div class="ttd-label">{{ $petugas_baru->nama }}<br>NIK: {{ $petugas_baru->nik }}</div>
    </div>
  </div>

</body>
</html>