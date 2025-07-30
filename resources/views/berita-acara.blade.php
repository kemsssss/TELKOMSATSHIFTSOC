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

@php
  $logoPath = public_path('storage/logotelkomsat/Logo-Telkomsat.png'); // Ganti sesuai nama file logo Anda
  $logoBase64 = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : null;
@endphp

@if($logoBase64)
  <div class="logo">
    <img src="{{ $logoBase64 }}" alt="Logo Telkomsat">
  </div>
@endif

<h2>BERITA ACARA SERAH TERIMA SHIFT SOC <span style="color: red;">TELKOMSAT</span></h2>
<div class="section">


<p><strong>Yang bertanda tangan di bawah ini:</strong></p>
@foreach ($petugas_lama as $petugas)
  <p>Nama: {{ $petugas->nama }}</p>
  <p>NIK: {{ $petugas->nik }}</p>
@endforeach
<p>Shift Lama: {{ $lama_shift }}</p>

<p><strong>Serah terima shift dengan:</strong></p>
@foreach ($petugas_baru as $petugas)
  <p>Nama: {{ $petugas->nama }}</p>
  <p>NIK: {{ $petugas->nik }}</p>
@endforeach

<p>Shift Baru: {{ $baru_shift }}</p>



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

@php
    $ttdLamaBase64 = [];

    foreach ($petugas_lama->take(1) as $p) {
        $path = public_path('storage/' . $p->ttd);
        $ttdLamaBase64[] = [
            'nama' => $p->nama,
            'nik' => $p->nik,
            'img' => file_exists($path) ? 'data:image/png;base64,' . base64_encode(file_get_contents($path)) : null
        ];
    }

    $ttdBaruBase64 = [];

    foreach ($petugas_baru->take(1) as $p) {
        $path = public_path('storage/' . $p->ttd);
        $ttdBaruBase64[] = [
            'nama' => $p->nama,
            'nik' => $p->nik,
            'img' => file_exists($path) ? 'data:image/png;base64,' . base64_encode(file_get_contents($path)) : null
        ];
    }
@endphp

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>Petugas Lama</th>
        <th>Petugas Baru</th>
    </tr>
    <tr>
        <td valign="top">
            @foreach ($ttdLamaBase64 as $ttd)
                <p>Nama: {{ $ttd['nama'] }}<br>NIK: {{ $ttd['nik'] }}</p>
                @if ($ttd['img'])
                    <img src="{{ $ttd['img'] }}" height="100" alt="TTD Petugas Lama"><br>
                @else
                    <p class="text-red">TTD tidak tersedia</p>
                @endif
            @endforeach
        </td>
        <td valign="top">
            @foreach ($ttdBaruBase64 as $ttd)
                <p>Nama: {{ $ttd['nama'] }}<br>NIK: {{ $ttd['nik'] }}</p>
                @if ($ttd['img'])
                    <img src="{{ $ttd['img'] }}" height="100" alt="TTD Petugas Baru"><br>
                @else
                    <p class="text-red">TTD tidak tersedia</p>
                @endif
            @endforeach
        </td>
    </tr>
</table>



</body>
</html>
