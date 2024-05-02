@include('components.theme.pages.header')
<div class="mb-3 d-flex">
    <a href="{{ route('pembayaran') }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
    <a href="{{ route('pembayaran.print', $pembayaran->no_periksa) }}" class="btn btn-sm btn-dark ml-2"><i class="fas fa-print"></i> Cetak</a>
</div>
<div class="row mb-4">
    <div class="col-md-{{ $pemeriksaan->status_pembayaran == 1 ? '7' : '8' }}">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pembayaran: {{ $pemeriksaan->no_periksa }}</h6>
            </div>
            <div class="card-body mb-n1">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2" class="text-center text-primary">Informasi Pasien</th>
                    </tr>
                    <tr>
                        <th>No. RM</th>
                        <td>{{ $pembayaran->user->no_rm }}</td>
                    </tr>
                    <tr>
                        <th>No. Registrasi</th>
                        <td>{{ $pembayaran->user->no_register }}</td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $pembayaran->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Periksa</th>
                        <td>{{ \Carbon\Carbon::parse($pemeriksaan->antrian->time_in)->isoFormat('dddd, D MMMM Y') ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center text-primary">Informasi Obat</th>
                    </tr>
                    @php $total_obat = 0; @endphp
                    @foreach(explode(',', $resep->id_obat) as $obat)
                        @php
                            $total_obat += \App\Models\Obat::where('id', $obat)->first()->price;
                        @endphp
                    <tr>
                        @php $name = \App\Models\Obat::where('id', $obat)->first()->name ?? '-' @endphp
                        @php $harga = \App\Models\Obat::where('id', $obat)->first()->price ?? '-' @endphp
                        <th>{{ $name }} <span class="text-muted small">x 1</span></th>
                        <td class="text-danger">Rp. {{ number_format($harga, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>Sub Total (Obat)</th>
                        <td class="text-danger">Rp. {{ number_format($total_obat, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center text-primary">Informasi Tindakan</th>
                    </tr>
                    <tr>
                        <th>Tindakan: {{ $tindakan->name }}</th>
                        <td class="text-danger">Rp. {{ number_format($tindakan->price, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @if($pemeriksaan->status_pembayaran == 2)
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Lengkapi Pembayaran</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pembayaran.process', $pembayaran->id) }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="total_harga">Uang Bayar</label>
                        <input type="number" name="biaya" id="biaya" class="form-control" value="{{ old('biaya') }}" required>
                        @if($errors->has('biaya'))<span class="small text-danger mt-2">{{ $errors->first('biaya') }}</span>@endif
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pembayaran</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        @php
                            if($pembayaran->user->is_anggota == 1) {
                                $total_harga = $total_obat + $tindakan->price;
                                $name = 'Pasien tergolong sebagai Non ASKES (Bayar: Biaya Obat + Pemeriksaan)';
                            } else {
                                $total_harga = $total_obat;
                                $name = 'Pasien tergolong sebagai ASKES (Bayar: Biaya Obat)';
                            }
                        @endphp
                        <th><p class="mb-0">
                            Total Harga<br>
                            <span class="small" style="font-style: italic">{{ $name }}</span>
                        </p></th>
                        <td class="align-middle text-success">Rp. {{ number_format($total_harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        @php
                            if($pembayaran->user->is_anggota == 1) {
                                $biaya = $pemeriksaan->biaya;
                                $status = $pemeriksaan->status_pembayaran == 1 ? 'Lunas' : 'Belum Lunas';
                            } else {
                                $biaya = $pemeriksaan->biaya;
                                $status = $pemeriksaan->status_pembayaran == 1 ? 'Lunas' : 'Belum Lunas';
                            }
                        @endphp
                        <th>Bayar</th>
                        <td class="align-middle text-success">Rp. {{ number_format($biaya, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        @php
                            $kembalian = $pemeriksaan->biaya - $total_harga;
                        @endphp
                        <th>Kembalian</th>
                        <td class="align-middle text-danger">Rp. {{ number_format($kembalian, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        @php
                            if($pembayaran->user->is_anggota == 1) {
                                $biaya = $pemeriksaan->biaya;
                                $status = $pemeriksaan->status_pembayaran == 1 ? 'Lunas' : 'Belum Lunas';
                            } else {
                                $biaya = $pemeriksaan->biaya;
                                $status = $pemeriksaan->status_pembayaran == 1 ? 'Lunas' : 'Belum Lunas';
                            }
                        @endphp
                        <th>Status Pembayaran</th>
                        <td class="align-middle text-dark font-weight-bold">{{ $status }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@include('components.theme.pages.footer')
