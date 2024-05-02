@include('components.theme.pages.header')
<div class="mb-3 d-flex">
    <a href="{{ site_url('dokter', 'resep-obat') }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
    <a href="{{ site_url('dokter', 'resep-obat/print') . '/' . $pemeriksaan->id }}" class="btn btn-sm btn-dark ml-2"><i class="fas fa-print"></i> Cetak Resep</a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Resep Obat: {{ $pemeriksaan->no_periksa }}</h6>
            </div>
            <div class="card-body mb-0">
                <table class="table table-bordered">
                    <tr>
                        <th>No. Pemeriksaan</th>
                        <td>{{ $pemeriksaan->no_periksa }}</td>
                    </tr>
                    <tr>
                        <th>Diagnosa</th>
                        <td class="text-danger">{{ \App\Models\Pemeriksaan::where('no_periksa', $pemeriksaan->no_periksa)->first()->diagnosa ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tindakan</th>
                        <td class="text-primary">{{ \App\Models\Tindakan::where('id', \App\Models\Pemeriksaan::where('no_periksa', $pemeriksaan->no_periksa)->first()->tindakan)->first()->name ?? '-' }}
                    </tr>
                    <tr>
                        <th>Resep Obat</th>
                        <td class="text-primary">
                        @php $no = 1; @endphp
                        @foreach(explode(',', $resep->id_obat) as $obat)
                            {{ $no++ }}. {{ \App\Models\Obat::where('id', $obat)->first()->name ?? '-' }}<br>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Aturan Pakai dari Dokter</th>
                        <td class="text-primary">
                            @php $no = 1; @endphp
                            @foreach(explode(',', $resep->description) as $aturan)
                                {{ $no++ }}. {{ $aturan }}<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Periksa</th>
                        <td>{{ \Carbon\Carbon::parse($pemeriksaan->time_in)->format('d/m/Y H:i:s') ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@include('components.theme.pages.footer')
