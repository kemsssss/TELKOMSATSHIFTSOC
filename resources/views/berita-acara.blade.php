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

    table {
      width: 100%;
      border-collapse: collapse;
    }

    .ttd-table td {
      text-align: center;
      vertical-align: top;
      width: 50%;
      padding-top: 40px;
    }

    .ttd-table img {
      margin-bottom: 10px;
    }

    .ttd-label {
      text-decoration: underline;
      font-weight: bold;
      display: inline-block;
      margin-top: 10px;
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

  {{-- Logo Telkomsat --}}
  <div class="logo">
    <img src="{{ public_path('logo_telkomsat.png') }}" alt="Telkomsat Logo">
  </div>

  <h2>BERITA ACARA SERAH TERIMA SHIFT SOC <span style="color: red;">TELKOMSAT</span></h2>

  {{-- Data Petugas --}}
  <div class="section">
    <p><strong>Yang bertanda tangan di bawah ini:</strong></p>
    <p>Nama: {{ $petugas_lama->nama }}</p>
    <p>NIK: {{ $petugas_lama->nik }}</p>
    <p>Shift: {{ $petugas_lama->shift }}</p>

    <p><strong>Serah terima shift dengan:</strong></p>
    <p>Nama: {{ $petugas_baru->nama }}</p>
    <p>NIK: {{ $petugas_baru->nik }}</p>
    <p>Shift: {{ $petugas_baru->shift }}</p>
  </div>

  {{-- Rincian Shift --}}
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

  {{-- Penutup --}}
  <div class="section">
    <p>Sekian telah kami laksanakan pekerjaan tersebut dengan baik. Demikian berita acara ini dibuat dengan sebaik-baiknya.</p>
  </div>

  {{-- Tanda Tangan --}}
  <table class="ttd-table">
    <tr>
      <td>
        Petugas Lama<br><br>
        @if($lama_ttd)
          <img src="data:image/png;base64,{{ $lama_ttd }}" height="80" alt="TTD Lama"><br>
        @else
          <br><br><br><br>
        @endif
        <div class="ttd-label">{{ $petugas_lama->nama }}</div><br>
        NIK: {{ $petugas_lama->nik }}
      </td>

      <td>
        Petugas Baru<br><br>
        @if($baru_ttd)
          <img src="data:image/png;base64,{{ $baru_ttd }}" height="80" alt="TTD Baru"><br>
        @else
          <br><br><br><br>
        @endif
        <div class="ttd-label">{{ $petugas_baru->nama }}</div><br>
        NIK: {{ $petugas_baru->nik }}
      </td>
    </tr>
  </table>

</body>
</html>
