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
                                    <th>No. Periksa</th>
                                    <th>No. RM</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Poli</th>
                                    <th>Diagnosa</th>
                                    <th>Tanggal Kunjungan</th>
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
            ajax: "{{ site_url('dokter', 'rekam-medis') }}",
            columns: [
                {data: null, name: 'id'},
                {data: 'no_periksa', name: 'no_periksa'},
                {data: 'no_rm', name: 'no_rm'},
                {data: 'nama', name: 'nama'},
                {data: 'kelamin', name: 'kelamin'},
                {data: 'poli', name: 'poli'},
                {data: 'diagnosa', name: 'diagnosa'},
                {data: 'tanggal_kunjungan', name: 'tanggal_kunjungan'},
                {data: null, name: 'action', orderable: false, searchable: false}
            ],
            columnDefs: [
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    render: function (data, type, row) {
                        return `
                            <a href="{{ site_url('dokter', 'rekam-medis/print') }}/${row.no_periksa}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-print"></i> Cetak</a>
                            <a href="{{ site_url('dokter', 'rekam-medis/detail') }}/${row.no_periksa}" class="btn btn-dark btn-sm ml-2"><i class="fa fa-eye"></i> Detail</a>
                        `;
                    }
                }
            ],
            createdRow: function (row, data, dataIndex) {
                // Set the sequential number starting from 1
                $('td', row).eq(0).html(dataIndex + 1);
            }
        });
    });
    </script>
@endpush
@include('components.theme.pages.footer')
