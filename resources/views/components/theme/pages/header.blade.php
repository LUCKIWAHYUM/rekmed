
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>eKlinis - {{ $data['subtitle']}}</title>
  <link href="<?= frontend('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= frontend("css/sb-admin-2.min.css")?>" rel="stylesheet">
  <link href="<?= frontend("vendor/datatables/dataTables.bootstrap4.min.css")?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ frontend('summernote/summernote-bs4.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  @stack('css')
</head>

<body id="page-top">
  <div id="wrapper">
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="
        background-color: #2c98a9 !important;
        background-image: linear-gradient(180deg, #2c98a9 10%, #112151 100%) !important;
        background-size: cover !important;
      ">
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="@if(user()->level == 1) {{ app_url('dashboard') }} @else {{ site_url('user', '/') }} @endif">
            <div class="sidebar-brand-icon">
                    <i class="fas fa-clinic-medical" style="font-size: 15px !important"></i>
            </div>
            <div class="sidebar-brand-text mx-3" style="text-transform: math-auto;">eKlinis</div>
          </a>

          <!-- Divider -->
          <hr class="sidebar-divider mb-3">

          <!-- Nav Item - Dashboard -->
          <div class="sidebar-heading">
            Menu Utama
          </div>
          <li class="nav-item">
            <a class="nav-link" href="{{ user()->level == 1 ? app_url('dashboard') : check_nakes() }}">
                <i class="fas fa-home"></i>
                <span>Beranda</span></a>
          </li>

          @if(user()->level == 1)
            <li class="nav-item">
              <a class="nav-link" href="{{ app_url('pasien') }}">
                  <i class="fas fa-users"></i>
                  <span>Data Pasien</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ app_url('kunjungan') }}">
                  <i class="fas fa-history"></i>
                  <span>Data Kunjungan</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ app_url('dokter') }}">
                  <i class="fas fa-user-md"></i>
                  <span>Data Dokter</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ app_url('perawat') }}">
                  <i class="fas fa-user-nurse"></i>
                  <span>Data Perawat</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ app_url('apoteker') }}">
                  <i class="fas fa-people-carry"></i>
                  <span>Data Apoteker</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ app_url('users') }}">
                  <i class="fas fa-users"></i>
                  <span>Data Pengguna</span></a>
            </li>
            <hr class="sidebar-divider mb-3">

            <div class="sidebar-heading">
                Menu Lainnya
            </div>

            <li class="nav-item">
              <a class="nav-link" href="{{ app_url('pembayaran') }}">
                  <i class="fas fa-dollar-sign"></i>
                  <span>Data Pembayaran</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ app_url('cetak') }}">
                  <i class="fas fa-print"></i>
                  <span>Cetak Laporan</span></a>
            </li>


          @else
          @php
              $checkDokter = \App\Models\Dokter::where('id_user', user()->id)->exists();
          @endphp
            @if($checkDokter)
                <li class="nav-item">
                    <a class="nav-link" href="{{ site_url('dokter', 'pemeriksaan') }}">
                        <i class="fas fa-list"></i>
                        <span>Pemeriksaan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ site_url('dokter', 'tindakan') }}">
                        <i class="fas fa-check"></i>
                        <span>Tindakan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ site_url('dokter', 'resep-obat') }}">
                        <i class="fas fa-pills"></i>
                        <span>Resep Obat</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ site_url('dokter', 'rekam-medis') }}">
                        <i class="fas fa-database"></i>
                        <span>Rekam Medis</span></a>
                </li>
            @else
                @php
                    $checkPerawat = \App\Models\Perawat::where('id_user', user()->id)->exists();
                @endphp
                    @if($checkPerawat)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('perawat', 'pemeriksaan') }}">
                                <i class="fas fa-list"></i>
                                <span>Pemeriksaan</span></a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('apoteker', 'obat') }}">
                                <i class="fas fa-pills"></i>
                                <span>Obat</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ site_url('apoteker', 'obat-pasien') }}">
                                <i class="fas fa-list"></i>
                                <span>Obat Pasien</span></a>
                        </li>
                    @endif
                @endif
          @endif
          <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Keluar</span></a>
          </li>

          <hr class="sidebar-divider d-none d-md-block">
          <div class="text-center d-none d-md-inline">
              <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>
      </ul>

      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="img-profile rounded-circle" src="{{ gravatar_team(user()->email) }}">
                  <span class="ml-2 d-none d-lg-inline text-gray-600 small">{{ user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  @if(user()->level == 1)
                    <a class="dropdown-item" href="{{ app_url('account') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Ubah profil
                    </a>
                  @else
                    <a class="dropdown-item" href="{{ site_url('user', 'account') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Ubah profil
                    </a>
                  @endif
                  <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                  </a>
                </div>
              </li>
            </ul>
          </nav>

          <div class="container-fluid">
