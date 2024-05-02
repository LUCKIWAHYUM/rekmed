@include('components.theme.pages.header')
<section>
    <div class="row mb-4">
        <div class="col-md-4 mb-2">
            <div class="card border-left-warning shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Antrian Menunggu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Antrian::where('status', 1)->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card border-left-dark shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Antrian Pemeriksaan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Antrian::where('status', 2)->where('id_dokter', user()->id)->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card border-left-success shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Antrian Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Antrian::where('status', 3)->where('id_dokter', user()->id)->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
                </div>
                <div class="card-body">
                    Selamat datang kembali, {{ user()->name }}
                </div>
            </div>
        </div>

    </div>
</section>
@include('components.theme.pages.footer')
