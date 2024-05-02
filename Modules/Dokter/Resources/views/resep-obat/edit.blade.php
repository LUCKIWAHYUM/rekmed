<section>
    <form method="POST" action="{{ site_url('dokter', 'resep-obat/update') }}/{{ $resep->no_periksa }}">
        @csrf
        <div class="row">
            <div class="col-md-6 form-group mb-3">
                <label for="exampleFormControlTextarea1">No. RM<sup class="text-danger">*</sup></label>
                <input type="hidden" name="no_periksa" value="{{ $pemeriksaan->no_periksa }}">
                <input type="text" name="no_rm" class="form-control" value="{{ $pemeriksaan->antrian->user->no_rm }}" readonly>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="exampleFormControlTextarea1">Nama Lengkap<sup class="text-danger">*</sup></label>
                <input type="text" name="nama" class="form-control" value="{{ $pemeriksaan->antrian->user->nama }}" readonly>
            </div>
            <div class="col-md-12 form-group mb-3">
                <label for="exampleFormControlTextarea1">Diagnosa<sup class="text-danger">*</sup></label>
                <input type="text" name="nama" class="form-control" value="{{ $pemeriksaan->diagnosa }}" readonly>
            </div>
            <div class="col-md-12 form-group mb-3">
                <label for="exampleFormControlTextarea1">Tindakan dari Dokter<sup class="text-danger">*</sup></label>
                <div class="alert alert-info mt-2 mb-0" role="alert">
                    {{ \App\Models\Tindakan::where('id', $pemeriksaan->tindakan)->first()->name ?? '-' }}
                </div>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="exampleFormControlTextarea1">Obat<sup class="text-danger">*</sup></label>
                <select name="id_obat[]" class="form-control obat-select" multiple required>
                    <option value="">Pilih Obat</option>
                    @foreach(explode(',', $resep->id_obat) as $obat2)
                        @php
                            $name = \App\Models\Obat::where('id', $obat2)->first()->name;
                        @endphp
                        <option value="{{ $obat2 }}" selected>{{ $name }}</option>
                    @endforeach
                    @foreach(\App\Models\Obat::whereNotIn('id', explode(',', $resep->id_obat))->get() as $obat)
                        <option value="{{ $obat->id }}">{{ $obat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="exampleFormControlTextarea1">Aturan Pakai<sup class="text-danger">*</sup></label>
                <input type="text" name="description" class="form-control" placeholder="Aturan Pakai" value="{{ $resep->description }}" required>
            </div>
        </div>
        <div class="form-group mb-3">
            <input type="checkbox" name="is_pribadi" value="1" {{ $resep->is_pribadi == 1 ? 'checked' : '' }}> Centang jika obat dibeli luar apotik
        </div>
        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
        </div>
    </form>
</section>

<script>
    $(document).ready(function() {
        $('.obat-select').select2();
    });
</script>
