@include('components.theme.pages.header')
<div class="mb-3">
    <a href="{{ site_url('dokter', 'rekam-medis') }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pemeriksaan: {{ $pemeriksaan->no_periksa }}</h6>
            </div>
            <div class="card-body mb-0">
                <table class="table table-bordered">
                    <tr>
                        <th>No. Pemeriksaan</th>
                        <td>{{ $pemeriksaan->no_periksa }}</td>
                    </tr>
                    <tr>
                        <th>No. RM</th>
                        <td>#{{ $pemeriksaan->user->no_rm }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $pemeriksaan->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>TTL</th>
                        <td>{{ $pemeriksaan->user->tempat_lahir }}, {{ $pemeriksaan->user->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $pemeriksaan->user->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <th>Usia</th>
                        <td>{{ $pemeriksaan->user->usia }} th</td>
                    </tr>
                    <tr>
                        <th>Poli</th>
                        <td>{{ $pemeriksaan->poli->name }}</td>
                    </tr>
                    <tr>
                        <th>Diagnosa</th>
                        <td class="text-danger">{{ \App\Models\Pemeriksaan::where('no_periksa', $pemeriksaan->no_periksa)->first()->diagnosa ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tindakan</th>
                        <td class="text-primary">{{ \App\Models\Tindakan::where('id', \App\Models\Pemeriksaan::where('no_periksa', $pemeriksaan->no_periksa)->first()->tindakan)->first()->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Keluhan Pasien</th>
                        <td class="text-danger">{{ \App\Models\Pemeriksaan::where('no_periksa', $pemeriksaan->no_periksa)->first()->keluhan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>TB/BB</th>
                        <td>{{ \App\Models\Pemeriksaan::where('no_periksa', $pemeriksaan->no_periksa)->first()->tinggi . ' cm' ?? '-' }} / {{ \App\Models\Pemeriksaan::where('no_periksa', $pemeriksaan->no_periksa)->first()->berat . ' kg' ?? '-' }}</td>
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
