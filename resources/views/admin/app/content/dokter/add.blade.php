@include('components.theme.pages.header')

<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Dokter</h6>
                    <p class="m-0 ml-auto small"><span class="text-danger">*</span> Wajib diisi</p>
                </div>
                <div class="card-body">
                    {{ Form::open(['route' => 'dokter.store']) }}
                    @csrf
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @else
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                    @endif
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Nama Dokter<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('nama_dokter') ? 'is-invalid' : '' }}" id="email" name="nama_dokter" aria-describedby="emailHelp" placeholder="Enter Nama Dokter." value="<?= old('nama_dokter') ?>">
                            @if($errors->has('nama_dokter'))<span class="small text-danger mt-2">{{ $errors->first('nama_dokter') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Nomer Induk STR<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('nomer_induk') ? 'is-invalid' : '' }}" id="email" name="nomer_induk" aria-describedby="emailHelp" placeholder="Enter Nomer Induk." value="<?= old('nomer_induk') ?>">
                            @if($errors->has('nomer_induk'))<span class="small text-danger mt-2">{{ $errors->first('nomer_induk') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Alamat Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Alamat Email." value="<?= old('email') ?>">
                            @if($errors->has('email'))<span class="small text-danger mt-2">{{ $errors->first('email') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Kata Sandi<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('password') ? 'is-invalid' : '' }}" id="email" name="password" aria-describedby="emailHelp" placeholder="Enter Kata Sandi." value="<?= old('password') ?>">
                            @if($errors->has('password'))<span class="small text-danger mt-2">{{ $errors->first('password') }}</span>@endif
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleEmail1">Poli Pelayanan<span class="text-danger">*</span></label>
                        <select class="form-control form-control-user {{ $errors->has('id_poli') ? 'is-invalid' : '' }}" id="exampleSelectRounded0" name="id_poli">
                            <option value="">-- Pilih Poli --</option>
                            @foreach($poli as $pelayanan)
                                <option value="{{ $pelayanan->id }}" {{ old('id_poli') == $pelayanan->id ? 'selected' : '' }}>{{ $pelayanan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Alamat Dokter<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('alamat') ? 'is-invalid' : '' }}" id="email" name="alamat" aria-describedby="emailHelp" placeholder="Enter Alamat." value="<?= old('alamat') ?>">
                            @if($errors->has('alamat'))<span class="small text-danger mt-2">{{ $errors->first('alamat') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Nomer Telepon<span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-user {{ $errors->has('telepon') ? 'is-invalid' : '' }}" id="email" name="telepon" aria-describedby="emailHelp" placeholder="Enter Nomer Telepon: 6289xxxxx." value="<?= old('telepon') ?>">
                            @if($errors->has('telepon'))<span class="small text-danger mt-2">{{ $errors->first('telepon') }}</span>@endif
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleEmail1">Jadwal Praktek<span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-user {{ $errors->has('jadwal_praktek') ? 'is-invalid' : '' }}" name="jadwal_praktek" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Jadwal Praktek."><?= old('jadwal_praktek') ?></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('dokter') }}" class="btn btn-light btn-light">Kembali</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.theme.pages.footer')
