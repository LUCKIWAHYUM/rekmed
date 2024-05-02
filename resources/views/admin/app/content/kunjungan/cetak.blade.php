@include('components.theme.pages.header')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Cetak Laporan Kunjungan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Bulan Periode</th>
                                <th>Tahun Periode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kunjungan as $key => $k)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($k[0]->created_at)->isoFormat('MMMM') }}</td>
                                <td>{{ date('Y', strtotime($k[0]->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('cetakExcel', ['id' => date('m', strtotime($k[0]->created_at))]) }}" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    })
</script>
@endpush
@include('components.theme.pages.footer')
