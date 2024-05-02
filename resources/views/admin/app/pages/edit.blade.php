@include('components.theme.pages.header')

<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => ['page.update', 'id' => $id], 'id' => 'form-tag-update']) }}
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
                            <label for="exampleEmail1">Nama Judul</label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('title') ? 'is-invalid' : '' }}" id="email" name="title" aria-describedby="emailHelp" placeholder="Enter Nama Judul." value="<?= $posts->title ?>">
                            @if($errors->has('title'))<span class="small text-danger mt-2">{{ $errors->first('title') }}</span>@endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleEmail1">Deskripsi</label>
                            <input type="text" class="form-control form-control-user {{ $errors->has('description') ? 'is-invalid' : '' }}" id="email" name="description" aria-describedby="emailHelp" placeholder="Enter Deskripsi URL" value="<?= $posts->description ?>">
                            @if($errors->has('description'))<span class="small text-danger mt-2">{{ $errors->first('description') }}</span>@endif
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('page') }}" class="btn btn-light btn-light">Kembali</a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.theme.pages.footer')
