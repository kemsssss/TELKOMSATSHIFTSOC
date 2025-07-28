<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Berita Acara Shift SOC</title>
  <style>
    @page {
      size: A4;
      margin: 10mm;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      font-size: 13px;
      color: #000;
    }

    .logo {
      text-align: center;
      margin-bottom: 8px;
    }

    .logo img {
      height: 60px;
    }

    h2 {
      text-align: center;
      font-size: 16px;
      text-transform: uppercase;
      margin-bottom: 16px;
    }

    .section {
      margin-bottom: 16px;
      page-break-inside: avoid;
    }

    ul, ol {
      margin-left: 20px;
      padding-left: 10px;
    }

    .ttd-area {
      margin-top: 40px;
      display: flex;
      justify-content: space-between;
      text-align: center;
      page-break-inside: avoid;
    }

    .ttd-area div {
      width: 45%;
    }

    .ttd-label {
      margin-top: 30px;
      text-decoration: underline;
      font-weight: bold;
    }

    table {
      width: 100%;
      text-align: center;
      margin-top: 30px;
      page-break-inside: avoid;
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

@if($logo)
  <div class="logo">
    <img src="data:image/png;base64,{{ $logo }}" alt="Logo Telkomsat">
  </div>
@endif

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

<table>
  <tr>
    <td>
      Petugas Lama<br><br>
      @if($lama_ttd)
        <img src="data:image/png;base64,{{ $lama_ttd }}" height="150" alt="TTD Lama"><br>
      @endif
      <div class="ttd-label">
        <strong>{{ $petugas_lama->nama }}</strong><br>
        NIK: {{ $petugas_lama->nik }}
      </div>
    </td>
    <td>
      Petugas Baru<br><br>
      @if($baru_ttd)
        <img src="data:image/png;base64,{{ $baru_ttd }}" height="150" alt="TTD Baru"><br>
      @endif
      <div class="ttd-label">
        <strong>{{ $petugas_baru->nama }}</strong><br>
        NIK: {{ $petugas_baru->nik }}
      </div>
    </td>
  </tr>
</table>

</body>
</html>
