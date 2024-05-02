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
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
        var filterStatus;

        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users') }}",
            order: [[1, 'desc']],
            stateSave: true,
            columns: [
                {data: null, name: 'id'},
                {data: 'title-post', name: 'title-post'},
                {data: 'email', name: 'email'},
                {data: 'status', name: 'status'},
                {data: null},
            ],
            columnDefs: [
            {
                targets: -1,
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Aksi
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ app_url('users') . '/edit' }}/${row.id}">Edit</a>
                            <a class="dropdown-item" href="{{ app_url('users') . '/delete' }}/${row.id}">Hapus</a>
                        </div>
                    `;
                },
            }
            ],
            createdRow: function (row, data, dataIndex) {
                // Set the sequential number starting from 1
                $('td', row).eq(0).html(dataIndex + 1);
            }
        });

        table.search('').draw();

        // #myInput is a <input type="text"> element
        $('#search').on('keyup change', function () {
            table.search('user|' + this.value).draw();
        });
    });

</script>
@endpush
@include('components.theme.pages.footer')
