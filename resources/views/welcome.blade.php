<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Berita Acara Shift SOC Telkomsat</title>
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">  
</head>
<body>
  <div class="container">
    <img src="{{ asset('assets/Logo-Telkomsat.png') }}" alt="Logo Telkomsat" style="display:block;margin:auto;height:60px;">
    <h1>BERITA ACARA</h1>
    <h2>SERAH TERIMA SHIFT SOC TELKOMSAT</h2>

  <form action="{{ route('generate.pdf') }}" method="POST">
    @csrf

    <label>Petugas Lama</label>
    <select name="petugas_lama_id" required>
      @foreach ($petugas as $p)
        <option value="{{ $p->id }}">{{ $p->nama }}</option>
      @endforeach
    </select>

          <label>Shift</label>
      <select name="shift" required>
        <option value="">-- Pilih Shift --</option>
        <option value="1">1</option>
        <option value="2">2</option>
      </select>

    <label>Petugas Baru</label>
    <select name="petugas_baru_id" required>
      @foreach ($petugas as $p)
        <option value="{{ $p->id }}">{{ $p->nama }}</option>
      @endforeach
    </select>

  <label for="shift">Shift:</label>
  <select name="shift" id="shift" required>
    <option value="">-- Pilih Shift --</option>
    <option value="1">1</option>
    <option value="2">2</option>
      </select>

    <label>Tanggal Shift</label>
    <input type="date" name="tanggal_shift" value="{{ date('Y-m-d') }}">
        <label>Nomor Tiket</label>
        <input type="text" name="tiket_nomor" placeholder="#12345">
        
<div class="section">
  <h3>Auto Blocking SOAR</h3>
  <div>
    <label for="soar_sangfor">SangFOR:</label>
    <input type="number" id="soar_sangfor" name="soar_sangfor" value="0" placeholder="Jumlah Sangfor">
  </div>
  <label for="soar_fortijtn">Forti-JTN:</label>
  <div>
    <input type="number" id="soar_fortijtn" name="soar_fortijtn" value="0" placeholder="Jumlah Forti-JTN">
  </div>
  <div>
    <label for="soar_fortiweb">FortiWeb:</label>
    <input type="number" id="soar_fortiweb" name="soar_fortiweb" value="0" placeholder="Jumlah FortiWeb">
  </div>
  <div>
    <label for="soar_checkpoint">CheckPoint:</label>
    <input type="number" id="soar_checkpoint" name="soar_checkpoint" value="0" placeholder="Jumlah CheckPoint">
  </div>
</div>

<!-- MANUAL BLOCKING DAN FOLLOWUP -->
<div class="section">
  <h3>Manual Blocking dan FollowUP</h3>

  <div id="sophos-ip-group">
    <label>Sophos IP:</label>
    <input type="text" name="sophos_ip[]" placeholder="Mauskan IP">
  </div>

  <div id="sophos-url-group">
    <label>Sophos URL:</label>
    <input type="text" name="sophos_url[]" placeholder="Masukkan URL">
  </div>

  <div id="vpn-group">
    <label>VPN:</label>
    <input type="text" name="vpn[]" placeholder="Masukkan VPN">
  </div>

  <div id="edr-group">
    <label>EDR:</label>
    <input type="text" name="edr[]" placeholder="Masukkan EDR">
  </div>

  <div id="magnus-group">
    <label>Daily Report Magnus:</label>
    <input type="text" name="magnus[]" placeholder="Masukkan laporan Magnus">
  </div>
</div>
</ul>

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
  
  
</div>
</div>

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