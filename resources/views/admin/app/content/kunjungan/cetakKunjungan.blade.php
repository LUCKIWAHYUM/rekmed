<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #000;
            font-size: 11px;
        }
        th, td {
            text-align: center;
            padding: 8px;
            font-size: 11px;
        }

        @page {
            margin: 0;
        }
        tr:nth-child(even){background-color: #f2f2f2}
    </style>
</head>
<body onload="window.print();">
    <h2 align="center" style="margin-top: 40px; margin-bottom: 40px">Laporan Kunjungan Bulan {{ date('F', strtotime($detail[0]->created_at)) }}</h2>
    <table border="1">
        <tr>
            <th>TGL</th>
            <th>NO. REGISTER</th>
            <th>NO. RM</th>
            <th>NO. ASKES</th>
            <th>NAMA</th>
            <th>TGL LAHIR</th>
            <th>UMUR</th>
            <th>JENIS KELAMIN</th>
            <th>DIAGNOSA</th>
            <th>TERAPI</th>
            <th>STATUS</th>
        </tr>

        @foreach($detail as $k)
        <tr>
            <td>{{ $k->created_at }}</td>
            <td>{{ $k->user->no_register }}</td>
            <td>{{ $k->user->no_rm }}</td>
            <td>{{ $k->user->no_dana_sehat ?? '-' }}</td>
            <td>{{ $k->user->nama }}</td>
            <td>{{ $k->user->tanggal_lahir }}</td>
            <td>{{ $k->user->usia }} th</td>
            <td>{{ $k->user->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>{{ \App\Models\Pemeriksaan::where('no_periksa', $k->no_periksa)->first()->diagnosa }}</td>
            <td>
            @php
                $obat = \App\Models\Resep::where('no_periksa', $k->no_periksa)->first()->id_obat;
                $nama = [];
            @endphp
            @foreach(explode(',', $obat) as $o)
                @php
                    $ob = \App\Models\Obat::where('id', $o)->first();
                    array_push($nama, $ob->name);
                @endphp
            @endforeach
                {{ implode(', ', $nama) }}
            </td>
            <td>{{ $k->user->status == 1 ? 'Baru' : 'Lama' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
