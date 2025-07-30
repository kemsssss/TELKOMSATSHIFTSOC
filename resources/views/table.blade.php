<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Berita Acara Shift</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
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
                        <th>Nama Petugas Lama</th>
                        <th>NIK Petugas Lama</th>
                        <th>Shift Petugas Lama</th>
                        <th>Nama Petugas Baru</th>
                        <th>NIK Petugas Baru</th>
                        <th>Shift Petugas Baru</th>
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

                            {{-- Petugas Lama --}}
                            <td>
                                @foreach ($data->petugasLama as $petugas)
                                    {{ $petugas->nama }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($data->petugasLama as $petugas)
                                    {{ $petugas->nik }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($data->petugasLama as $petugas)
                                    {{ $data->lama_shift }}<br>
                                @endforeach
                            </td>

                            {{-- Petugas Baru --}}
                            <td>
                                @foreach ($data->petugasBaru as $petugas)
                                    {{ $petugas->nama }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($data->petugasBaru as $petugas)
                                    {{ $petugas->nik }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($data->petugasBaru as $petugas)
                                    {{ $data->baru_shift }}<br>
                                @endforeach
                            </td>

                            {{-- Data lainnya --}}
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
            updateJam();
        });
    </script>

</body>
</html>
