<form method="POST" action="{{ site_url('perawat', 'pemeriksaan/process') . '/' . $antrian->id }}">
    @csrf
    <div class="form-group mb-3">
        <label for="exampleFormControlTextarea1">No. RM<sup class="text-danger">*</sup></label>
        <input type="text" name="no_rm" class="form-control" value="" required>
    </div>
    <div class="form-group mb-3">
        <label for="exampleFormControlTextarea1">Nama Pasien<sup class="text-danger">*</sup></label>
        <input type="text" name="nama" class="form-control" value="{{ $antrian->user->nama }}" readonly>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlTextarea1">Jenis Kelamin<sup class="text-danger">*</sup></label>
            <input type="text" name="jenis_kelamin" class="form-control" value="{{ $antrian->user->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}" readonly>
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlTextarea1">Tanggal Lahir<sup class="text-danger">*</sup></label>
            <input type="text" name="tanggal_lahir" class="form-control" value="{{ $antrian->user->tanggal_lahir }}" readonly>
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlTextarea1">Tgl Kunjungan<sup class="text-danger">*</sup></label>
            <input type="text" name="tanggal_kunjungan" class="form-control" value="{{ $antrian->time_in }}" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlTextarea1">Tinggi Badan<sup class="text-danger">*</sup></label>
            <input type="number" name="tinggi" class="form-control" value="" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlTextarea1">Berat Badan<sup class="text-danger">*</sup></label>
            <input type="number" name="berat" class="form-control" value="" required>
        </div>
        <div class="col-md-12 mb-3">
            <label for="exampleFormControlTextarea1">Keluhan<sup class="text-danger">*</sup></label>
            <textarea class="form-control" name="keluhan" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlTextarea1">Tekanan Darah<sup class="text-danger">*</sup></label>
            <input type="text" name="tekanan" class="form-control" value="" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlTextarea1">Denyut Nadi<sup class="text-danger">*</sup></label>
            <input type="text" name="nadi" class="form-control" value="" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlTextarea1">Alergi<sup class="text-danger ml-2">opsional</sup></label>
            <input type="text" name="alergi" class="form-control" value="">
        </div>
        <div class="col-md-12">
            <label for="exampleFormControlTextarea1">Keterangan Tambahan<sup class="text-danger ml-2">opsional</sup></label>
            <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
    </div>
    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
