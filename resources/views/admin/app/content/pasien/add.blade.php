@include('components.theme.pages.header')

<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Pasien</h6>
                    <p class="m-0 ml-auto small"><span class="text-danger">*</span> Wajib diisi</p>
                </div>
                <div class="card-body">
                    {{ Form::open(['route' => 'pasien.store']) }}
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
                        <div class="col-md-3 form-group mb-3">
                            <label for="exampleEmail1">Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('name') ? 'is-invalid' : '' }}" id="email" name="name" aria-describedby="emailHelp" placeholder="Enter Nama." value="<?= old('name') ?>">
                            @if($errors->has('name'))<span class="small text-danger mt-2">{{ $errors->first('name') }}</span>@endif
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label for="exampleEmail1">Nomer KTP<span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-user {{ $errors->has('no_ktp') ? 'is-invalid' : '' }}" id="email" name="no_ktp" aria-describedby="emailHelp" placeholder="Enter Nomer KTP." value="<?= old('no_ktp') ?>">
                            @if($errors->has('no_ktp'))<span class="small text-danger mt-2">{{ $errors->first('no_ktp') }}</span>@endif
                        </div>
                        <div class="col-md-2 form-group mb-3">
                            <label for="exampleEmail1">Nomor RM<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('no_rm') ? 'is-invalid' : '' }}" id="email" name="no_rm" aria-describedby="emailHelp" placeholder="Enter No RM." value="<?= old('no_rm') ?>">
                            @if($errors->has('no_rm'))<span class="small text-danger mt-2">{{ $errors->first('no_rm') }}</span>@endif
                        </div>
                        <div class="col-md-2 form-group mb-3">
                            <label for="exampleEmail1">Nomor Registrasi<span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-user {{ $errors->has('no_regis') ? 'is-invalid' : '' }}" id="email" name="no_regis" aria-describedby="emailHelp" placeholder="Enter No Registrasi." value="<?= old('no_regis') ?>">
                            @if($errors->has('no_regis'))<span class="small text-danger mt-2">{{ $errors->first('no_regis') }}</span>@endif
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label for="exampleEmail1">Nomor Dana Sehat<span class="text-danger small ml-2">opsional</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('no_dana_sehat') ? 'is-invalid' : '' }}" id="email" name="no_dana_sehat" aria-describedby="emailHelp" placeholder="Enter No Dana Sehat." value="<?= old('no_dana_sehat') ?>">
                            @if($errors->has('no_dana_sehat'))<span class="small text-danger mt-2">{{ $errors->first('no_dana_sehat') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Tempat Lahir<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}" id="email" name="tempat_lahir" aria-describedby="emailHelp" placeholder="Enter Tempat Lahir." value="<?= old('tempat_lahir') ?>">
                            @if($errors->has('tempat_lahir'))<span class="small text-danger mt-2">{{ $errors->first('tempat_lahir') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Tanggal Lahir<span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-user {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}" id="email" name="tanggal_lahir" aria-describedby="emailHelp" placeholder="Enter Tanggal Lahir." value="<?= old('tanggal_lahir') ?>">
                            @if($errors->has('tanggal_lahir'))<span class="small text-danger mt-2">{{ $errors->first('tanggal_lahir') }}</span>@endif
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label for="exampleEmail1">Agama<span class="text-danger">*</span></label>
                            <select name="agama" class="form-control {{ $errors->has('agama') ? 'is-invalid' : '' }}">
                                <option value="">Pilih Agama</option>
                                @foreach([1, 2, 3, 4, 5] as $agama)
                                    @php
                                        $name = $agama == 1 ? 'Islam' : ($agama == 2 ? 'Kristen' : ($agama == 3 ? 'Katolik' : ($agama == 4 ? 'Hindu' : 'Budha')));
                                    @endphp
                                    <option value="{{ $agama }}" {{ old('agama') == $agama ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('agama'))<span class="small text-danger mt-2">{{ $errors->first('agama') }}</span>@endif
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label for="exampleEmail1">Pekerjaan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('pekerjaan') ? 'is-invalid' : '' }}" id="email" name="pekerjaan" aria-describedby="emailHelp" placeholder="Enter Pekerjaan." value="<?= old('pekerjaan') ?>">
                            @if($errors->has('pekerjaan'))<span class="small text-danger mt-2">{{ $errors->first('pekerjaan') }}</span>@endif
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label for="exampleEmail1">Telepon<span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-user {{ $errors->has('telepon') ? 'is-invalid' : '' }}" id="email" name="telepon" aria-describedby="emailHelp" placeholder="Enter Telepon." value="<?= old('telepon') ?>">
                            @if($errors->has('telepon'))<span class="small text-danger mt-2">{{ $errors->first('telepon') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Usia<span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-user {{ $errors->has('usia') ? 'is-invalid' : '' }}" id="email" name="usia" aria-describedby="emailHelp" placeholder="Enter Usia." value="<?= old('usia') ?>">
                            @if($errors->has('usia'))<span class="small text-danger mt-2">{{ $errors->first('usia') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Jenis Kelamin<span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}">
                                <option value="">Pilih Jenis Kelamin</option>
                                @foreach([1, 2] as $gender)
                                    @php $name = $gender == 1 ? 'Laki - Laki' : 'Perempuan'  @endphp
                                    <option value="{{ $gender }}" {{ old('category') == $gender ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('jenis_kelamin'))<span class="small text-danger mt-2">{{ $errors->first('jenis_kelamin') }}</span>@endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Status Pasien<span class="text-danger">*</span></label>
                            <select name="status" class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                <option value="">Pilih Status</option>
                                @foreach([1, 2] as $status)
                                    @php $name = $status == 1 ? 'Baru' : 'Lama'  @endphp
                                    <option value="{{ $status }}" {{ old('category') == $status ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))<span class="small text-danger mt-2">{{ $errors->first('status') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Status Anggota<span class="text-danger">*</span></label>
                            <select name="is_anggota" class="form-control {{ $errors->has('is_anggota') ? 'is-invalid' : '' }}">
                                <option value="">Pilih Status Anggota</option>
                                @foreach([1, 2] as $anggota)
                                    @php $name = $anggota == 1 ? 'Bukan Anggota' : 'Anggota Dana Sehat'  @endphp
                                    <option value="{{ $anggota }}" {{ old('category') == $anggota ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('is_anggota'))<span class="small text-danger mt-2">{{ $errors->first('is_anggota') }}</span>@endif
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pasien') }}" class="btn btn-light btn-light">Kembali</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.theme.pages.footer')
