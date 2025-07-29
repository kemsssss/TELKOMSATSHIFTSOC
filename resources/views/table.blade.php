<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Berita Acara Shift</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9fafb;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 240px;
            background-color: #1d3557;
            color: white;
            padding: 20px;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 240px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .table-container {
            overflow-x: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead {
            background-color: #0d6efd;
            color: white;
        }

        th, td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        tbody tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        tbody tr:hover {
            background-color: #e2e8f0;
            transition: background-color 0.2s;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions form {
            display: inline;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding: 10px;
            }

            table {
                font-size: 12px;
            }
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
        <h1>Tabel Berita Acara Shift SOC Telkomsat</h1>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Shift</th>
                        <th>Petugas Lama</th>
                        <th>NIK Lama</th>
                        <th>Petugas Baru</th>
                        <th>NIK Baru</th>
                        <th>No Tiket</th>
                        <th>Sangfor</th>
                        <th>FortiJTN</th>
                        <th>FortiWeb</th>
                        <th>Checkpoint</th>
                        <th>Sophos IP</th>
                        <th>Sophos URL</th>
                        <th>VPN</th>
                        <th>EDR</th>
                        <th>Daily Report Magnus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beritaAcaras as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $data->lama_shift }}</td>
                            <td>{{ $data->lama_nama }}</td>
                            <td>{{ $data->lama_nik }}</td>
                            <td>{{ $data->baru_nama }}</td>
                            <td>{{ $data->baru_nik }}</td>
                            <td>{!! nl2br(e($data->tiket)) !!}</td>
                            <td>{!! nl2br(str_replace(',', "\n", e($data->sangfor))) !!}</td>
                            <td>{!! nl2br(str_replace(',', "\n", e($data->jtn))) !!}</td>
                            <td>{!! nl2br(str_replace(',', "\n", e($data->web))) !!}</td>
                            <td>{!! nl2br(str_replace(',', "\n", e($data->checkpoint))) !!}</td>
                            <td>{!! nl2br(str_replace(',', "\n", e($data->sophos_ip))) !!}</td>
                            <td>{!! nl2br(str_replace(',', "\n", e($data->sophos_url))) !!}</td>
                            <td>{!! nl2br(str_replace(',', "\n", e($data->vpn))) !!}</td>
                            <td>{!! nl2br(str_replace(',', "\n", e($data->edr))) !!}</td>
                            <td>{!! nl2br(e($data->daily_report)) !!}</td>
                            <td class="actions">
                                <a href="{{ route('beritaacara.edit', $data->id) }}" class="btn btn-edit">Edit</a>
                                <form action="{{ route('beritaacara.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
