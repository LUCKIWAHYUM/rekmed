<div class="row">
    <div class="col-md-12">
        @if(empty($data))
            <div class="alert alert-danger" role="alert">
                Data pasien tidak ditemukan, Silahkan klik link <a href="{{ app_url('pasien/create') }}">disini</a> untuk menambahkan data pasien baru
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Nomor KTP</td>
                                <td>{{ $data->no_ktp }}</td>
                            </tr>
                            <tr>
                                <td>No. RM</td>
                                <td>{{ $data->no_rm }}</td>
                            </tr>
                            <tr>
                                <td>No. Dana Sehat</td>
                                <td>{{ $data->no_dana_sehat }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>{{ $data->agama == 1 ? 'Islam' : ($data->agama == 2 ? 'Kristen' : ($data->agama == 3 ? 'Katholik' : ($data->agama == 4 ? 'Hindu' : 'Budha'))) }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>{{ $data->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <td>TTL</td>
                                <td>{{ $data->tempat_lahir }} - {{ $data->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <td>Telepon</td>
                                <td>{{ $data->telepon }}</td>
                            </tr>
                        </table>
                    </div>
                    <form action="{{ app_url('kunjungan/process') }}" method="POST">
                        @csrf
                        <div class="form-group mt-3 mb-0">
                            <input type="hidden" name="no_ktp" value="{{ $data->no_ktp }}">
                            <label for="exampleEmail1">Waktu Kunjungan</label>
                            <input type="datetime-local" name="time_in" class="form-control mb-2" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleEmail1">Dokter</label>
                            <select name="id_dokter" class="form-control">
                                <option value="">Pilih Dokter</option>
                                @foreach(\App\Models\Dokter::get() as $dokter)
                                    <option value="{{ $dokter->id }}">{{ $dokter->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleEmail1">Perawat</label>
                            <select name="id_perawat" class="form-control">
                                <option value="">Pilih Perawat</option>
                                @foreach(\App\Models\Perawat::get() as $perawat)
                                    <option value="{{ $perawat->id }}">{{ $perawat->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">Buat Kunjungan</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
