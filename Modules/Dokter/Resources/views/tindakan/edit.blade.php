@include('components.theme.pages.header')

<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h6 class="m-0 font-weight-bold text-primary">Perbarui Tindakan</h6>
                    <p class="m-0 ml-auto small"><span class="text-danger">*</span> Wajib diisi</p>
                </div>
                <div class="card-body">
                    {{ Form::open(['route' => ['tindakan.update', $tindakan->id]]) }}
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
                        <label for="exampleEmail1">Nama<span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-user {{ $errors->has('name') ? 'is-invalid' : '' }}" id="email" name="name" aria-describedby="emailHelp" placeholder="Enter Nama." value="{{ $tindakan->name }}">
                        @if($errors->has('name'))<span class="small text-danger mt-2">{{ $errors->first('name') }}</span>@endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleEmail1">Harga<span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-user {{ $errors->has('price') ? 'is-invalid' : '' }}" id="email" name="price" aria-describedby="emailHelp" placeholder="Enter Harga Layanan." value="{{ $tindakan->price }}">
                        @if($errors->has('price'))<span class="small text-danger mt-2">{{ $errors->first('price') }}</span>@endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleEmail1">Keterangan Tindakan<span class="text-danger">*</span></label>
                        <textarea placeholder="Enter Keterangan" class="form-control form-control-user {{ $errors->has('description') ? 'is-invalid' : '' }}" id="exampleFormControlTextarea1" rows="3" name="description">{{ $tindakan->description }}</textarea>
                        @if($errors->has('description'))<span class="small text-danger mt-2">{{ $errors->first('price') }}</span>@endif
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('tindakan') }}" class="btn btn-light btn-light">Kembali</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.theme.pages.footer')
