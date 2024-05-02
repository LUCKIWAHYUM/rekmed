@include('components.theme.pages.header')
<div class="mb-3 d-flex">
    <a href="{{ site_url('apoteker', 'obat-pasien') }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
    <a href="{{ site_url('apoteker', 'obat-pasien/print') . '/' . $pemeriksaan->id }}" class="btn btn-sm btn-dark ml-2"><i class="fas fa-print"></i> Cetak Resep</a>
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
                        <td>{{ \Carbon\Carbon::parse($pemeriksaan->antrian->time_in)->isoFormat('dddd, D MMMM Y') ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@include('components.theme.pages.footer')
