@include('components.theme.pages.header')
<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">

            <div class="d-flex mb-4">
                <h1 class="h3 text-gray-800">{{ $data['subtitle'] }}</h1>
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
                                    <th>No. Antrian</th>
                                    <th>No. RM</th>
                                    <th>Nama</th>
                                    <th>Poli</th>
                                    <th>Status</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Waktu Kunjungan</th>
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

<div class="modal fade" id="clearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
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
            ajax: "{{ site_url('dokter', 'pemeriksaan') }}",
            columns: [
                {data: null, name: 'id'},
                {data: 'kode', name: 'kode'},
                {data: 'no_rm', name: 'no_rm'},
                {data: 'nama', name: 'nama'},
                {data: 'poli', name: 'poli'},
                {data: 'is_status', name: 'is_status'},
                {data: 'tanggal_kunjungan', name: 'tanggal_kunjungan'},
                {data: 'jam_kunjungan', name: 'jam_kunjungan'},
                {data: 'register', name: 'register'},
                {data: null, name: 'action', orderable: false, searchable: false}
            ],
            columnDefs: [
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    render: function (data, type, row) {
                        if(row.is_status_antrian == 2 && row.diagnosa === null && row.tindakan === null) {
                            return `
                                <div class="d-flex">
                                    <button class="btn btn-primary btn-sm periksa" data-id="${row.id}" data-toggle="modal" data-target="#clearModal"><i class="fa fa-camera"></i> Periksa</button>
                                    <a href="{{ site_url('dokter', 'pemeriksaan/detail') }}/${row.id}" class="btn btn-dark btn-sm ml-2"><i class="fa fa-eye"></i> Detail</a>
                                </div>
                            `;
                        } else if (row.is_status_antrian == 2 && row.diagnosa !== null && row.tindakan !== null && row.jumlah_foto < 0) {
                            return `
                                <div class="d-flex">
                                    <button class="btn btn-primary btn-sm foto" data-id="${row.id}" data-toggle="modal" data-target="#clearModal"><i class="fa fa-camera"></i> Foto Fisik</button>
                                    <a href="{{ site_url('dokter', 'pemeriksaan/detail') }}/${row.id}" class="btn btn-dark btn-sm ml-2"><i class="fa fa-eye"></i> Detail</a>
                                </div>
                            `;
                        } else {
                            return `
                                <a href="{{ site_url('dokter', 'pemeriksaan/detail') }}/${row.id}" class="btn btn-dark btn-sm ml-2"><i class="fa fa-eye"></i> Detail</a>
                            `;
                        }
                    }
                }
            ],
            createdRow: function (row, data, dataIndex) {
                // Set the sequential number starting from 1
                $('td', row).eq(0).html(dataIndex + 1);
            }
        });

        $(document).on('click', '.periksa', function () {
            event.preventDefault();
            $('.modal-title').html('Periksa Pasien');
            var id_periksa = $(this).data('id');
            $.ajax({
                url: `{{ site_url('dokter', 'pemeriksaan/formPeriksa') }}`,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id_periksa
                },
                beforeSend: function () {
                    $('.result').html(`
                    <div class="text-center">
                        <div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div>
                    </div>`);
                },
                success: function (data) {
                    $('.result').html(data);
                }
            });
        });

        $(document).on('click', '.foto', function () {
            event.preventDefault();
            $('.modal-title').html('Lampiran Foto Fisik');
            var id_periksa = $(this).data('id');
            $.ajax({
                url: `{{ site_url('dokter', 'pemeriksaan/formLampiran') }}`,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id_periksa
                },
                beforeSend: function () {
                    $('.result').html(`
                    <div class="text-center">
                        <div class="spinner-border text-primary text-center" role="status"><span class="sr-only">Loading...</span></div>
                    </div>`);
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
