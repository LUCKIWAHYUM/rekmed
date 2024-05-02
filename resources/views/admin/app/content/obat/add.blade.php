@include('components.theme.pages.header')

<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Obat</h6>
                    <p class="m-0 ml-auto small"><span class="text-danger">*</span> Wajib diisi</p>
                </div>
                <div class="card-body">
                    {{ Form::open(['route' => 'obat.store']) }}
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
                            <label for="exampleEmail1">Nama Obat<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('name') ? 'is-invalid' : '' }}" id="email" name="name" aria-describedby="emailHelp" placeholder="Enter Nama Obat." value="<?= old('name') ?>">
                            @if($errors->has('name'))<span class="small text-danger mt-2">{{ $errors->first('name') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Kode Obat<span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('kode_obat') ? 'is-invalid' : '' }}" id="email" name="kode_obat" aria-describedby="emailHelp" placeholder="Enter Kode Obat." value="<?= old('kode_obat') ?>">
                            @if($errors->has('kode_obat'))<span class="small text-danger mt-2">{{ $errors->first('kode_obat') }}</span>@endif
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label for="exampleEmail1">Keterangan<span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-user {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Keterangan."><?= old('description') ?></textarea>
                            @if($errors->has('description'))<span class="small text-danger mt-2">{{ $errors->first('description') }}</span>@endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Kategori<span class="text-danger">*</span></label>
                            <select name="category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}">
                                <option value="">Pilih Kategori</option>
                                @foreach([1, 2, 3, 4, 5, 6] as $category)
                                    @php $name = $category == 1 ? 'Tablet' : ($category == 2 ? 'Kapsul' : ($category == 3 ? 'Kaplet' : ($category == 4 ? 'Pil' : ($category == 5 ? 'Puyer' : 'Sirup')))) @endphp
                                    <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))<span class="small text-danger mt-2">{{ $errors->first('category') }}</span>@endif
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="exampleEmail1">Stok<span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-user {{ $errors->has('stock') ? 'is-invalid' : '' }}" id="email" name="stock" aria-describedby="emailHelp" placeholder="Enter Stok." value="<?= old('stock') ?>">
                            @if($errors->has('stock'))<span class="small text-danger mt-2">{{ $errors->first('stock') }}</span>@endif
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label for="exampleEmail1">Harga<span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-user {{ $errors->has('price') ? 'is-invalid' : '' }}" id="email" name="price" aria-describedby="emailHelp" placeholder="Enter Harga." value="<?= old('price') ?>">
                            @if($errors->has('price'))<span class="small text-danger mt-2">{{ $errors->first('price') }}</span>@endif
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('obat') }}" class="btn btn-light btn-light">Kembali</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.theme.pages.footer')
