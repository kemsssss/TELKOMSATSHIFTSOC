<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Berita Acara Shift</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">  
    <style>
        .btn-edit, .btn-print {
            display: inline-block;
            padding: 6px 10px;
            margin: 2px;
            font-size: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
        }

        .btn-edit:hover {
            background-color: #0056b3;
        }

        .btn-print {
            background-color: #4CAF50;
            color: white;
        }

        .btn-print:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        @include('components.sidebar')
    </div>

    <div id="jam" style="position: absolute; top: 20px; right: 30px; font-size: 14px; color: #555; z-index: 9999;"></div>

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
                                <a href="{{ route('beritaacara.print', $data->id) }}" class="btn btn-print" target="_blank">Print</a>
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
