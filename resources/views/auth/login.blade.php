<x-theme.auth.authentication__-header :data="$data" />
<div class="container py-5">
    <div class="row my-5 justify-content-center">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Halaman Masuk</h1>
                                </div>
                                <form class="user" action="{{ route('proses_login') }}" method="POST">
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
                                    <div class="form-group">
                                        <input type="password"
                                            class="form-control form-control-user {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            id="password" name="password" placeholder="Password">
                                        @if($errors->has('password'))<span
                                            class="small text-danger mt-2">{{ $errors->first('password') }}</span>@endif
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
