@include('components.theme.pages.header')

<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => 'users.store']) }}
                    @csrf
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label">Email Address<sup class="text-danger">*</sup></label>
                                <input type="email" name="email" value="{{ old('email') }}" autocomplete="off" class="form-control form-control-solid mt-2 {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter Email Address">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Full Name<sup class="text-danger">*</sup></label>
                                <input type="text" name="name" value="{{ old('name') }}" autocomplete="off" class="form-control form-control-solid mt-2 {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter Name">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-2" data-kt-password-meter="true">
                            <label class="form-label">Password<sup class="text-muted ml-2">(opsional)</sup></label>
                            <input type="text" name="password" value="{{ old('password') }}" autocomplete="off" class="form-control form-control-solid mt-2 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter Password">
                            <p class="small text-danger mt-2">keterangan: default password adalah default123</p>
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Roles<sup class="text-danger">*</sup></label>
                                <select name="level" class="form-control mt-2 {{ $errors->has('level') ? 'is-invalid' : '' }}">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('level') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Status Account<sup class="text-danger">*</sup></label>
                                <select name="status" class="form-control mt-2 {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                    @foreach ([1,2,3,4] as $rolez)
                                        @php $name = $rolez == 1 ? 'Active' : ($rolez == 2 ? 'Non Active' : ($rolez == 3 ? 'Deactivated' : 'Not Verified')) @endphp
                                        <option value="{{ $rolez }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('users') }}" class="btn btn-light btn-light">Back</a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.theme.pages.footer')
