@include('components.theme.pages.header')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="h6 text-primary m-0">Umum</h3>
                </div>
                <div class="card-body">
                <form action="{{ route('update.account') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6 form-group">
                            <label class="form-label">Nama Lengkap<sup class="ms-1 text-danger">*</sup></label>
                            <input type="text" name="name" class="form-control form-control-solid mt-2" value="{{ user()->name }}" placeholder="Nama Lengkap">
                        </div>
                        <div class="col-6 form-group">
                            <label class="form-label">Alamat Email<sup class="ms-1 text-danger">*</sup></label>
                            <input type="email" name="email" class="form-control form-control-solid mt-2" id="email" value="{{ user()->email }}" placeholder="Alamat Email">
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label mb-3">Kata Sandi<span class="ml-2 small fs-8 text-danger">opsional (kosongi jika tidak ingin merubah)</span></label>
                        <input type="password" name="password" class="form-control form-control-solid" value="" placeholder="Kata Sandi">
                    </div>
                    <div class="form-group mb-n1">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@include('components.theme.pages.footer')
