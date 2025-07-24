<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Berita Acara PDF</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 20px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .content {
      margin-bottom: 30px;
    }
    .signature {
      margin-top: 60px;
      display: flex;
      justify-content: space-between;
      text-align: center;
    }
    .signature div {
      width: 45%;
    }
    .signature-name {
      margin-top: 80px;
      text-decoration: underline;
    }
    img.ttd {
      height: 80px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <h2>Berita Acara Serah Terima Shift SOC Telkomsat</h2>

  <div class="content">
    <p>Pada tanggal: <strong>{{ $tanggal_shift }}</strong></p>
    <p>Telah dilakukan serah terima shift antara:</p>
    <p>Petugas Lama: <strong>{{ $petugas_lama->nama }}</strong></p>
    <p>Petugas Baru: <strong>{{ $petugas_baru->nama }}</strong></p>
    <p>Nomor Tiket: <strong>{{ $tiket_nomor ?? '-' }}</strong></p>
  </div>

  <div class="content">
    <h4>Auto Blocking SOAR</h4>
    <ul>
      <li>SangFOR: {{ $soar_sangfor ?? '-' }}</li>
      <li>Forti-JTN: {{ $soar_fortijtn ?? '-' }}</li>
      <li>FortiWeb: {{ $soar_fortiweb ?? '-' }}</li>
      <li>CheckPoint: {{ $soar_checkpoint ?? '-' }}</li>
    </ul>
  </div>

  <div class="content">
    <h4>Manual Blocking dan FollowUP</h4>
    <ul>
      <li>Sophos IP:
        <ul>
          @foreach ($sophos_ip ?? [] as $ip)
            <li>{{ $ip }}</li>
          @endforeach
        </ul>
      </li>
      <li>Sophos URL:
        <ul>
          @foreach ($sophos_url ?? [] as $url)
            <li>{{ $url }}</li>
          @endforeach
        </ul>
      </li>
      <li>VPN:
        <ul>
          @foreach ($vpn ?? [] as $v)
            <li>{{ $v }}</li>
          @endforeach
        </ul>
      </li>
      <li>EDR:
        <ul>
          @foreach ($edr ?? [] as $e)
            <li>{{ $e }}</li>
          @endforeach
        </ul>
      </li>
      <li>Daily Report Magnus:
        <ul>
          @foreach ($magnus ?? [] as $m)
            <li>{{ $m }}</li>
          @endforeach
        </ul>
      </li>
    </ul>
  </div>

  <div class="signature">
    <div>
      Petugas Lama<br>
      @if($lama_ttd)
        <img class="ttd" src="data:image/png;base64,{{ $lama_ttd }}" alt="TTD Lama">
      @endif
      <div class="signature-name">{{ $petugas_lama->nama }}</div>
    </div>
    <div>
      Petugas Baru<br>
      @if($baru_ttd)
        <img class="ttd" src="data:image/png;base64,{{ $baru_ttd }}" alt="TTD Baru">
      @endif
      <div class="signature-name">{{ $petugas_baru->nama }}</div>
    </div>
  </div>
</body>
</html>
