@include('components.theme.pages.header')
<section>
    <div class="row mb-4">
        <div class="col-md-3 mb-2">
            <div class="card border-left-info shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Apoteker</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $apoteker }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="card border-left-info shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Dokter</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dokter }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="card border-left-info shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Perawat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $perawat }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="card border-left-info shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pasien Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getPasienBulanIni }}</div>
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
                                Total Pemeriksaan Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getAntrianBulanIni }}</div>
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
                                Total Pembayaran Lunas Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getPembayaranLunasBulanIni }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card border-left-danger shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Pembayaran Belum Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $getPembayaranBelumBulanIni }}</div>
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
                    Selamat Datang kembali <b>{{ Auth::user()->name }}</b>!
                </div>
            </div>
        </div>

    </div>
</section>
@include('components.theme.pages.footer')
