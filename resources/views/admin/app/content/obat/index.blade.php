@include('components.theme.pages.header')
<section>
    <!-- basic table -->
    <div class="row">
        <div class="col-12">

            <div class="d-flex mb-4">
                <h1 class="h3 text-gray-800">{{ $data['subtitle'] }}</h1>
                @if(!empty($data['button']))
                    <!--begin::Action-->
                    <div class="ml-auto">
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
                                    <th>Kode Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Harga</th>
                                    <th>Stock</th>
                                    <th>Status</th>
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

@push('scripts')
    <script type="text/javascript">
    $(function () {

        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('obat') }}",
            columns: [
                {data: null, name: 'id'},
                {data: 'kode_obat', name: 'kode_obat'},
                {data: 'name', name: 'name'},
                {data: 'harga', name: 'harga'},
                {data: 'stock', name: 'stock'},
                {data: 'is_status', name: 'is_status'},
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
                                <a class="dropdown-item" href="{{ app_url('obat') . '/edit' }}/${row.id}">Edit</a>
                                <a class="dropdown-item" href="{{ app_url('obat') . '/delete' }}/${row.id}">Hapus</a>
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

    });
    </script>
@endpush
@include('components.theme.pages.footer')
