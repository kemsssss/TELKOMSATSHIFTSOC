<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Berita Acara Shift SOC Telkomsat</title>
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <style>
    .signature-outside {
  width: 210mm;
  margin: 20mm auto 0 auto;
  display: flex;
  justify-content: space-between;
  text-align: center;
}

.signature-outside div {
  width: 45%;
  padding-top: 60px;
  border-top: 1px solid #000;
}

@media print {
  .signature-outside {
    page-break-before: always;
  }
}

    .signature-space {
  height: 150px; /* bisa kamu atur, contoh 150px */
  margin-top: 60px;
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  text-align: center;
}

.signature-space div {
  width: 45%;
  border-top: 1px solid #000;
  padding-top: 6px;
}

    body {
      font-family: 'Figtree', sans-serif;
      background: #f0f0f0;
      margin: 0;
    }
    .container {
      
      padding: 24mm 20mm;
      margin: 0 auto;
      background: white;
    
    }
    h1, h2 {
      text-align: center;
      margin: 0;
    }
    h1 {
      font-size: 20px;
      color: #d32f2f;
      margin-bottom: 10px;
    }
    h2 {
      font-size: 18px;
      margin-bottom: 20px;
    }
    label {
      font-weight: 600;
    }
    select, input[type="text"], input[type="date"], input[type="number"] {
      width: 100%;
      padding: 6px;
      margin-top: 4px;
      margin-bottom: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .section {
      margin-bottom: 24px;
    }
    ul {
      padding-left: 20px;
    }
    .multi-input div.input-wrapper {
      display: flex;
      align-items: center;
      margin-bottom: 6px;
    }
    .multi-input input {
      flex: 1;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .multi-input button.delete-btn {
      margin-left: 8px;
      background: none;
      border: none;
      color: red;
      font-size: 18px;
      cursor: pointer;
    }
    .signatures {
      display: flex;
      justify-content: space-between;
      text-align: center;
      margin-top: 40px;
    }
    .signatures div {
      width: 45%;
    }
    @media print {
      body {
        background: none;
      }
      .container {
        box-shadow: none;
        page-break-after: always;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="{{ asset('assets/Logo-Telkomsat.png') }}" alt="Logo Telkomsat" style="display:block;margin:auto;height:60px;">
    <h1>BERITA ACARA</h1>
    <h2>SERAH TERIMA SHIFT SOC TELKOMSAT</h2>

    <div class="section">
      <label>Petugas Lama</label>
      <select name="petugas_lama">
        <option value="">Pilih Petugas Lama</option>
        <option>Andi - 123456 - Shift 1</option>
        <option>Budi - 654321 - Shift 2</option>
        <option>Citra - 112233 - Shift 3</option>
      </select>

      <label>Petugas Baru</label>
      <select name="petugas_baru">
        <option value="">Pilih Petugas Baru</option>
        <option>Dewi - 445566 - Shift 1</option>
        <option>Eka - 778899 - Shift 2</option>
        <option>Fajar - 990011 - Shift 3</option>
      </select>

      <label>Tanggal Shift</label>
      <input type="date" name="tanggal_shift" value="{{ date('Y-m-d') }}">
    </div>

    <div class="section">
      <label>Tiket yang dibuat</label>
      <input type="text" name="tiket_nomor" placeholder="Masukkan nomor tiket">
    </div>

    <div class="section">
      <label><b>Auto Blocking SOAR</b></label>
      <ul>
        <li>SangFOR <input type="number" name="soar_sangfor" value="0"></li>
        <li>Forti-JTN <input type="number" name="soar_fortijtn" value="0"></li>
        <li>FortiWeb <input type="number" name="soar_fortiweb" value="0"></li>
        <li>CheckPoint <input type="number" name="soar_checkpoint" value="0"></li>
      </ul>
    </div>

    <div class="section">
      <label><b>Manual Blocking dan FollowUP</b></label>
      <ul>
        <li>
          Sophos IP
          <div id="sophos-ip-group" class="multi-input">
            <div class="input-wrapper">
              <input type="text" name="sophos_ip[]" placeholder="Masukkan IP">
            </div>
          </div>
        </li>
        <li>
          Sophos URL
          <div id="sophos-url-group" class="multi-input">
            <div class="input-wrapper">
              <input type="text" name="sophos_url[]" placeholder="Masukkan URL">
            </div>
          </div>
        </li>
        <li>
          VPN
          <div id="vpn-group" class="multi-input">
            <div class="input-wrapper">
              <input type="text" name="vpn[]" placeholder="Masukkan VPN Data">
            </div>
          </div>
        </li>
        <li>
          EDR
          <div id="edr-group" class="multi-input">
            <div class="input-wrapper">
              <input type="text" name="edr[]" placeholder="Masukkan EDR Data">
            </div>
          </div>
        </li>
        <li>
          Daily Report Magnus
          <div id="magnus-group" class="multi-input">
            <div class="input-wrapper">
              <input type="text" name="magnus[]" placeholder="Masukkan laporan">
            </div>
          </div>
        </li>
      </ul>
    </div>

    <div class="section">
      <p>Demikian berita acara ini dibuat dengan sebenar-benarnya sebagai bukti telah dilakukan serah terima shift SOC Telkomsat.</p>
    </div>

    <form action="{{ route('generate.pdf') }}" method="POST">
    @csrf

    <label>Petugas Lama:</label>
    <select name="petugas_lama_id" required>
        @foreach($petugas as $p)
            <option value="{{ $p->id }}">{{ $p->nama }}</option>
        @endforeach
    </select>

    <label>Petugas Baru:</label>
    <select name="petugas_baru_id" required>
        @foreach($petugas as $p)
            <option value="{{ $p->id }}">{{ $p->nama }}</option>
        @endforeach
    </select>

    <button type="submit">Generate PDF</button>
</form>

    

  <script>
    function setupDynamicInput(groupId, inputName) {
      const group = document.getElementById(groupId);

      group.addEventListener('keydown', function (e) {
        if (e.target.tagName === 'INPUT' && e.key === 'Enter') {
          e.preventDefault();

          if (e.target.value.trim() === '') return;

          const wrapper = document.createElement('div');
          wrapper.className = 'input-wrapper';

          const newInput = document.createElement('input');
          newInput.type = 'text';
          newInput.name = inputName + '[]';
          newInput.placeholder = e.target.placeholder;

          const deleteBtn = document.createElement('button');
          deleteBtn.className = 'delete-btn';
          deleteBtn.innerHTML = '🗑️';
          deleteBtn.type = 'button';
          deleteBtn.onclick = () => group.removeChild(wrapper);

          wrapper.appendChild(newInput);
          wrapper.appendChild(deleteBtn);
          group.appendChild(wrapper);

          newInput.focus();
        }
      });
    }

    setupDynamicInput('sophos-ip-group', 'sophos_ip');
    setupDynamicInput('sophos-url-group', 'sophos_url');
    setupDynamicInput('vpn-group', 'vpn');
    setupDynamicInput('edr-group', 'edr');
    setupDynamicInput('magnus-group', 'magnus');
  </script>

</body>
</html>