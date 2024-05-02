@include('components.theme.pages.header')
<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">

            <div class="d-flex mb-4">
                <h1 class="h3 text-gray-800">{{ $data['subtitle'] }}</h1>
                @if(!empty($data['button']))
                    <!--begin::Action-->
                    <div class="ml-auto d-flex">
                        @php
                            $url = $data['module']['url'];
                        @endphp
                        <a href="{{ $data['module']['url'] }}" class="btn btn-primary">
                            {{ explode(' ', $data['module']['name'])[0] }} <span class="d-none d-sm-inline ps-2">{{ ucfirst(explode(' ', $data['module']['name'])[1]) }}</span>
                        </a>
                    </div>
                @endif
            </div>

            <div class="card">
                <div class="card-body">
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
                    <!--end::Wrapper-->
                    <div class="table-responsive">
                        <table id="data-table" class="table"  width="100%">
                            <thead>
                                <tr class="text-start">
                                    <th>ID</th>
                                    <th>Nomor KTP</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status</th>
                                    <th>Anggota ASKES</th>
                                    <th>Didaftarkan pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="findModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Temukan Pasien</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="no_ktp">Nomor KTP</label>
                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="Masukkan Nomor KTP">
                </div>
                <div class="result"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
    $(function () {

        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pasien') }}",
            columns: [
                {data: null, name: 'id'},
                {data: 'no_ktp', name: 'no_ktp'},
                {data: 'nama', name: 'nama'},
                {data: 'kelamin', name: 'kelamin'},
                {data: 'is_status', name: 'is_status'},
                {data: 'anggota', name: 'anggota'},
                {data: 'register', name: 'register'},
                {data: null, name: 'action', orderable: false, searchable: false}
            ],
            columnDefs: [
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ app_url('pasien') . '/edit' }}/${row.id}">Edit</a>
                                <a class="dropdown-item" href="{{ app_url('pasien') . '/delete' }}/${row.id}">Hapus</a>
                            </div>
                        `;
                    }
                }
            ],
            createdRow: function (row, data, dataIndex) {
                // Set the sequential number starting from 1
                $('td', row).eq(0).html(dataIndex + 1);
            }
        });

        $('input[name="no_ktp"]').on('change', function () {
            var no_ktp = $(this).val();
            $.ajax({
                url: "{{ app_url('pasien/find') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_ktp: no_ktp
                },
                beforeSend: function () {
                    $('.result').html('<div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div>');
                },
                success: function (data) {
                    $('.result').html(data);
                }
            });
        });
    });
    </script>
@endpush
@include('components.theme.pages.footer')
