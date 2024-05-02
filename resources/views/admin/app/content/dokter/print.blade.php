<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }

        /* general styling */
        body {
            font-family: "Open Sans", sans-serif;
            line-height: 1.25;
        }

        @page {
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
</head>

<body onload="window.print();">
    <table>
        <caption>Data Nasabah</caption>
        @foreach(\App\Models\User::where('level', 2)->get() as $user)
        <thead>
            <tr>
                <th scope="col" colspan="2">Account Officer: {{ $user->name }}</th>
            </tr>
            <tr>
                <th scope="col">Kode Nasabah</th>
                <th scope="col">Nama Nasabah</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\Alternatif::where('uplink', $user->id)->get() as $alt)
            @empty($alt)
            <tr>
                <td colspan="2">Tidak ada data</td>
            </tr>
            @else
            <tr>
                <td data-label="kode">{{ $alt->id_alternatif }}</td>
                <td data-label="nama">{{ $alt->nama_alternatif }}</td>
            </tr>
            @endempty
            @endforeach
        </tbody>
        @endforeach
    </table>
</body>

</html>
