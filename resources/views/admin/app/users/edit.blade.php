@include('components.theme.pages.header')

<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => ['users.update', 'id' => $id]]) }}
                    @csrf
                        <div class="row mb-4">
                            <div class="col">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" value="{{ $data['records']['email'] }}" autocomplete="off" class="form-control form-control-solid mt-2 {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Enter Email Address">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" value="{{ $data['records']['name'] }}" autocomplete="off" class="form-control form-control-solid mt-2 {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Enter Name">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-4" data-kt-password-meter="true">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" value="{{ old('password') }}" autocomplete="off" class="form-control form-control-solid mt-2 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter Password">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <label class="form-label">Roles</label>
                                <select name="level" class="form-control mt-2 {{ $errors->has('level') ? 'is-invalid' : '' }}">
                                    @foreach ($roles as $role)
                                        @php $selected = $data['records']['level'] == $role->id ? 'selected' : '' @endphp
                                        @php $selected_name = $data['records']['level'] == $role->id ? '(selected)' : '' @endphp
                                        <option value="{{ $role->id }}" {{ $selected }}>{{ $role->name }} {{ $selected_name }}</option>
                                    @endforeach
                                </select>
                                @error('level') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col">
                                <label class="form-label">Status Account</label>
                                <select name="status" class="form-control mt-2 {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                    @foreach ([1,2,3,4] as $roles)
                                        @php $name = $roles == 1 ? 'Active' : ($roles == 2 ? 'Non Active' : ($roles == 3 ? 'Deactivated' : 'Not Verified')) @endphp
                                        @php $selected = $data['records']['status'] == $roles ? 'selected' : '' @endphp
                                        @php $selected_name = $data['records']['status'] == $roles ? '(selected)' : '' @endphp
                                        <option value="{{ $roles }}" {{ $selected }}>{{ $name }} {{ $selected_name }}</option>
                                    @endforeach
                                </select>
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label">Thumbnail</label>
                            <input class="form-control form-control-solid mt-2 mb-3 {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" type="file" name="images">
                            @if(!empty($data['records']['thumbnail']))
                                <small class="text-muted">Found in: <a href="{{ asset('storage/images/'.$data['records']['thumbnail']) }}" target="_blank">{{ asset('storage/images/'.$data['records']['thumbnail']) }}</a></small>
                            @else
                                <small class="text-muted">No image found</small>
                            @endif
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('users') }}" class="btn btn-light btn-light">Kembali</a>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.theme.pages.footer')
