@include('components.theme.pages.header')

<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h6 class="m-0 font-weight-bold text-primary">Perbarui Kunjungan</h6>
                    <p class="m-0 ml-auto small"><span class="text-danger">*</span> Wajib diisi</p>
                </div>
                <div class="card-body">
                    {{ Form::open(['route' => ['kunjungan.update', $pasien->id]]) }}
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
                    <div class="form-group mb-3">
                        <label for="exampleEmail1">Poli<span class="text-danger">*</span></label>
                        <select name="id_poli" class="form-control">
                            <option value="">Pilih Poli</option>
                            @foreach(\App\Models\Poli::get() as $poli)
                                <option value="{{ $poli->id }}" {{ $kunjungan->id_poli == $poli->id ? 'selected' : '' }}>{{ $poli->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('id_poli'))<span class="small text-danger mt-2">{{ $errors->first('id_poli') }}</span>@endif
                    </div>
                    <div class="form-group mt-3 mb-0">
                        <label for="exampleEmail1">Waktu Kunjungan</label>
                        <input type="datetime-local" name="time_in" value="{{ $kunjungan->time_in }}" class="form-control mb-2" required>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('kunjungan') }}" class="btn btn-light btn-light">Kembali</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.theme.pages.footer')
