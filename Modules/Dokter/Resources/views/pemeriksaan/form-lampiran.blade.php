<form method="POST" enctype="multipart/form-data" action="{{ site_url('dokter', 'pemeriksaan/process-lampiran') . '/' . $antrian->id }}">
    @csrf
    <div class="form-group mb-3">
        <label for="exampleFormControlTextarea1">Diameter<sup class="text-danger">*</sup></label>
        <input type="text" name="diameter" class="form-control" value="" required>
    </div>
    <div class="form-group mb-3">
        <label for="exampleFormControlTextarea1">Jumlah<sup class="text-danger">*</sup></label>
        <input type="number" name="jumlah" class="form-control">
    </div>
    <div class="form-group mb-3">
        <label for="exampleFormControlTextarea1">Lampiran<sup class="text-danger">*</sup></label>
        <input type="file" name="foto" class="form-control">
    </div>
    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
