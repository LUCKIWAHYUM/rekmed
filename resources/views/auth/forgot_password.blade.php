<x-theme.auth.authentication__-header :data="$data" />
<div class="container py-5">
    <div class="row my-5">
        <div class="col-lg-6 my-auto">
            <h4 class="h3 mb-3 font-weight-bold text-white">KoperasiKu</h4>
            <p class="mb-0 text-white" style="width: 90%; text-align: justify;">
                Layanan KoperasiKu adalah platform untuk mengelola pengajuan pinjaman nasabah untuk keperluan internal dengan dilengkapi
                layanan keputusan menggunakan metode <i>SMART</i>. Layanan ini dapat menentukan calon nasabah yang dapat bergabung berdasarkan kriteria dan penilaian internal.
            </p>
        </div>
        <div class="col-lg-5 my-auto">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Lupa Kata Sandi</h1>
                                </div>
                                <form class="user" action="{{ route('forgotPassword') }}" method="POST">
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
                                    <div class="form-group">
                                        <input type="text"
                                            class="form-control form-control-user {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="email" name="email" aria-describedby="emailHelp"
                                            placeholder="Enter Email." value="<?= old('email') ?>">
                                        @if($errors->has('email'))<span
                                            class="small text-danger mt-2">{{ $errors->first('email') }}</span>@endif
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-theme.auth.authentication__-footer />
