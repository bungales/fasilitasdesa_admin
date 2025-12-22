@extends('layouts.app')

@section('content')
    <!-- Konten Utama -->
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Header Welcome -->
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Selamat Datang Bunga Lestari</h3>
                            <h6 class="font-weight-normal mb-0">Selamat Datang di Projek bina desa saya fasilitas desa
                                <span class="text-primary"> fasilitas umum admin!</span>
                            </h6>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Hari Ini (22 Dec 2035)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">Januari - Maret</a>
                                        <a class="dropdown-item" href="#">Maret - Juni</a>
                                        <a class="dropdown-item" href="#">Juni - Agustus</a>
                                        <a class="dropdown-item" href="#">Agustus - November</a>
                                    </div>
                                    <a href="{{ route('login.destroy') }}" class="btn btn-danger btn-sm ml-2">
                                        Keluar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 1: People Card + Statistics Cards -->
            <div class="row">
                <!-- People Card (Kiri) -->
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card tale-bg">
                        <div class="card-people mt-auto">
                            <img src="{{ asset('assets-admin/images/dashboard/people.svg') }}" alt="warga">
                            <div class="weather-info">
                                <div class="d-flex">
                                    <div>
                                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                                    </div>
                                    <div class="ml-2">
                                        <h4 class="location font-weight-normal">INDONESIA</h4>
                                        <h6 class="font-weight-normal">PEKANBARU</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4 Statistics Cards (Kanan) -->
                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <!-- Pemesanan Hari Ini -->
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Pemesanan Hari Ini</p>
                                    <p class="fs-30 mb-2">4006</p>
                                    <p>10.00% (30 hari)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Rapat -->
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Jumlah Rapat</p>
                                    <p class="fs-30 mb-2">34040</p>
                                    <p>2.00% (30 hari)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Total Pemesanan -->
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Pemesanan</p>
                                    <p class="fs-30 mb-2">61344</p>
                                    <p>25.00% (30 hari)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Klien -->
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Jumlah Klien</p>
                                    <p class="fs-30 mb-2">47033</p>
                                    <p>0.22% (30 hari)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================= -->
            <!-- DATA STATISTIK UTAMA -->
            <!-- ======================= -->
            <div class="row mt-4">
                <!-- Total Users -->
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Total Users</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">{{ App\Models\User::count() ?? 102 }}</h2>
                                <i class="mdi mdi-account-multiple icon-lg"></i>
                            </div>
                            <div class="mt-3">
                                <small class="text-light">Total 5 Run return tensed/s</small>
                                <div class="progress">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Warga -->
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Total Warga</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">{{ App\Models\Warga::count() ?? 100 }}</h2>
                                <i class="mdi mdi-home icon-lg"></i>
                            </div>
                            <div class="mt-3">
                                <small class="text-light">Total Warga Terdaftar</small>
                                <div class="progress">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fasilitas Umum -->
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Fasilitas Umum</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">{{ App\Models\FasilitasUmum::count() ?? 100 }}</h2>
                                <i class="mdi mdi-office-building icon-lg"></i>
                            </div>
                            <div class="mt-3">
                                <small class="text-light">Fasilitas Tersedia</small>
                                <div class="progress">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Program -->
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4">Total Program</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="mb-0">100</h2>
                                <i class="mdi mdi-file-document icon-lg"></i>
                            </div>
                            <div class="mt-3">
                                <small class="text-light">Program Aktif</small>
                                <div class="progress">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================= -->
            <!-- FITUR UTAMA & MASTER DATA -->
            <!-- ======================= -->
            <div class="row mt-4">
                <!-- FITUR UTAMA -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-gradient-primary text-white">
                            <h4 class="mb-0">
                                <i class="mdi mdi-star-circle mr-2"></i> Fitur Utama
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php
                                    $features = [
                                        [
                                            'icon' => 'mdi mdi-home-city',
                                            'title' => 'Fasilitas Umum',
                                            'description' => 'Kelola fasilitas desa',
                                            'color' => 'primary',
                                            'count' => App\Models\FasilitasUmum::count() ?? 100,
                                            'route' => 'fasilitasumum.index'
                                        ],
                                        [
                                            'icon' => 'mdi mdi-calendar-clock',
                                            'title' => 'Peminjaman Fasilitas',
                                            'description' => 'Kelola peminjaman',
                                            'color' => 'success',
                                            'count' => App\Models\PeminjamanFasilitas::count() ?? 100,
                                            'route' => 'peminjaman.index'
                                        ],
                                        [
                                            'icon' => 'mdi mdi-cash-multiple',
                                            'title' => 'Pembayaran Fasilitas',
                                            'description' => 'Kelola pembayaran',
                                            'color' => 'info',
                                            'count' => App\Models\PembayaranFasilitas::count() ?? 0,
                                            'route' => 'pembayaran.index'
                                        ],
                                        [
                                            'icon' => 'mdi mdi-file-document',
                                            'title' => 'Syarat Fasilitas',
                                            'description' => 'Kelola persyaratan',
                                            'color' => 'warning',
                                            'count' => App\Models\SyaratFasilitas::count() ?? 0,
                                            'route' => 'syarat-fasilitas.index'
                                        ],
                                        [
                                            'icon' => 'mdi mdi-account-tie',
                                            'title' => 'Petugas Fasilitas',
                                            'description' => 'Kelola petugas',
                                            'color' => 'danger',
                                            'count' => App\Models\PetugasFasilitas::count() ?? 0,
                                            'route' => 'petugas-fasilitas.index'
                                        ]
                                    ];
                                @endphp

                                @foreach($features as $feature)
                                <div class="col-12 mb-3">
                                    <a href="{{ route($feature['route']) }}" class="text-decoration-none">
                                        <div class="card border-left-{{ $feature['color'] }} border-left-3 h-100">
                                            <div class="card-body py-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-circle bg-{{ $feature['color'] }} text-white mr-3">
                                                            <i class="{{ $feature['icon'] }}"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="font-weight-bold mb-0">{{ $feature['title'] }}</h6>
                                                            <small class="text-muted">{{ $feature['description'] }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <span class="badge badge-{{ $feature['color'] }} badge-pill px-3 py-2">
                                                            {{ $feature['count'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="mdi mdi-information mr-1"></i> Total {{ count($features) }} fitur utama tersedia
                            </small>
                        </div>
                    </div>
                </div>

                <!-- MASTER DATA -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-gradient-success text-white">
                            <h4 class="mb-0">
                                <i class="mdi mdi-database mr-2"></i> Master Data
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Data Warga -->
                                <div class="col-12 mb-3">
                                    <a href="{{ route('warga.index') }}" class="text-decoration-none">
                                        <div class="card border-left-info border-left-3 h-100">
                                            <div class="card-body py-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-circle bg-info text-white mr-3">
                                                            <i class="mdi mdi-account-group"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="font-weight-bold mb-0">Data Warga</h6>
                                                            <small class="text-muted">Kelola data penduduk desa</small>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <span class="badge badge-info badge-pill px-3 py-2">
                                                            {{ App\Models\Warga::count() ?? 100 }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Data User -->
                                <div class="col-12 mb-3">
                                    <a href="{{ route('user.index') }}" class="text-decoration-none">
                                        <div class="card border-left-primary border-left-3 h-100">
                                            <div class="card-body py-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-circle bg-primary text-white mr-3">
                                                            <i class="mdi mdi-account-cog"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="font-weight-bold mb-0">User</h6>
                                                            <small class="text-muted">Kelola pengguna sistem</small>
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-3 text-right">
                                                                <div class="h4 mb-0">{{ App\Models\User::count() ?? 102 }}</div>
                                                                <small class="text-muted">Total</small>
                                                            </div>
                                                            <div class="text-right">
                                                                <div class="h4 mb-0">{{ App\Models\User::where('role', 'Administrator')->count() ?? 0 }}</div>
                                                                <small class="text-muted">Administrator</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- User Statistics Row -->
                                                <div class="row mt-3">
                                                    <div class="col-4 text-center">
                                                        <div class="stat-box bg-danger-light">
                                                            <div class="h6 mb-0">{{ App\Models\User::where('role', 'Super Admin')->count() ?? 0 }}</div>
                                                            <small class="text-muted">Super Admin</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <div class="stat-box bg-warning-light">
                                                            <div class="h6 mb-0">{{ App\Models\User::where('role', 'Administrator')->count() ?? 0 }}</div>
                                                            <small class="text-muted">Administrator</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <div class="stat-box bg-success-light">
                                                            <div class="h6 mb-0">{{ App\Models\User::where('role', 'Pelanggan')->count() ?? 0 }}</div>
                                                            <small class="text-muted">Pelanggan</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Data Master Lainnya -->
                                <div class="col-12">
                                    <div class="card border-left-secondary border-left-3">
                                        <div class="card-body py-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="font-weight-bold mb-0">Total Master Data</h6>
                                                    <small class="text-muted">2 master data tersedia</small>
                                                </div>
                                                <div class="text-right">
                                                    <span class="badge badge-secondary badge-pill px-3 py-2">
                                                        2
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="mdi mdi-information mr-1"></i> Total 2 master data tersedia
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================= -->
            <!-- SLIDESHOW GAMBAR INDONESIA -->
            <!-- ======================= -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <!-- Judul Slideshow -->
                    <div class="slideshow-header mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="font-weight-bold mb-1">Galeri Keindahan Indonesia</h3>
                                <p class="text-muted mb-0">Menyajikan keindahan alam dan fasilitas desa Indonesia</p>
                            </div>
                            <div class="slideshow-count">
                                <span class="badge badge-primary p-2">
                                    <i class="mdi mdi-image-multiple mr-1"></i> 3 Gambar
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Slideshow Container -->
                    <div class="card shadow">
                        <div class="card-body p-0">
                            <div id="indonesiaCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#indonesiaCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#indonesiaCarousel" data-slide-to="1"></li>
                                    <li data-target="#indonesiaCarousel" data-slide-to="2"></li>
                                </ol>

                                <div class="carousel-inner">
                                    <!-- Lapangan Desa -->
                                    <div class="carousel-item active">
                                        <div class="carousel-image-wrapper">
                                            <img src="{{ asset('assets-admin/images/dashboard/lapangan.jpg') }}"
                                                 class="d-block w-100"
                                                 alt="Lapangan Desa"
                                                 style="height: 450px; object-fit: cover;">
                                        </div>
                                        <div class="carousel-overlay"></div>
                                        <div class="carousel-caption">
                                            <div class="caption-content">
                                                <h3 class="caption-title">Lapangan Desa Indonesia</h3>
                                                <p class="caption-description">Tempat berkumpul dan berolahraga warga desa</p>
                                                <div class="caption-indicator">
                                                    <span class="indicator-dot active"></span>
                                                    <span class="indicator-dot"></span>
                                                    <span class="indicator-dot"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Aula Desa -->
                                    <div class="carousel-item">
                                        <div class="carousel-image-wrapper">
                                            <img src="{{ asset('assets-admin/images/dashboard/aula kursi.jpg') }}"
                                                 class="d-block w-100"
                                                 alt="Aula Desa"
                                                 style="height: 450px; object-fit: cover;">
                                        </div>
                                        <div class="carousel-overlay"></div>
                                        <div class="carousel-caption">
                                            <div class="caption-content">
                                                <h3 class="caption-title">Aula Desa Indonesia</h3>
                                                <p class="caption-description">Pusat kegiatan sosial dan administrasi desa</p>
                                                <div class="caption-indicator">
                                                    <span class="indicator-dot"></span>
                                                    <span class="indicator-dot active"></span>
                                                    <span class="indicator-dot"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pemandangan Desa -->
                                    <div class="carousel-item">
                                        <div class="carousel-image-wrapper">
                                            <img src="{{ asset('assets-admin/images/dashboard/pemandangan desa.jpg') }}"
                                                 class="d-block w-100"
                                                 alt="Pemandangan Desa"
                                                 style="height: 450px; object-fit: cover;">
                                        </div>
                                        <div class="carousel-overlay"></div>
                                        <div class="carousel-caption">
                                            <div class="caption-content">
                                                <h3 class="caption-title">Pemandangan Desa Indonesia</h3>
                                                <p class="caption-description">Keindahan alam pedesaan yang mempesona</p>
                                                <div class="caption-indicator">
                                                    <span class="indicator-dot"></span>
                                                    <span class="indicator-dot"></span>
                                                    <span class="indicator-dot active"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kontrol Navigasi -->
                                <a class="carousel-control carousel-control-prev" href="#indonesiaCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-icon" aria-hidden="true">
                                        <i class="mdi mdi-chevron-left"></i>
                                    </span>
                                    <span class="sr-only">Sebelumnya</span>
                                </a>
                                <a class="carousel-control carousel-control-next" href="#indonesiaCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-icon" aria-hidden="true">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                                    <span class="sr-only">Berikutnya</span>
                                </a>

                                <!-- Informasi Slideshow -->
                                <div class="carousel-info">
                                    <div class="info-content">
                                        <span class="info-item">
                                            <i class="mdi mdi-image-filter mr-1"></i> Gambar Terkompresi
                                        </span>
                                        <span class="info-divider">•</span>
                                        <span class="info-item">
                                            <i class="mdi mdi-timer-sand mr-1"></i>
                                        </span>
                                        <span class="info-divider">•</span>
                                        <span class="info-item">
                                            <i class="mdi mdi-responsive mr-1"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================= -->
            <!-- IDENTITAS PENGEMBANG -->
            <!-- ======================= -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Tentang Pengembang</h4>
                            <div class="row align-items-center">
                                <!-- Foto Profil -->
                                <div class="col-md-3 text-center">
                                    <div class="developer-photo mb-3">
                                        <img src="{{ asset('assets-admin/images/WhatsApp Image 2025-05-24 at 20.44.53_17f0cf70.jpg') }}"
                                            alt="Foto Bunga Lestari" class="img-fluid rounded-circle shadow"
                                            style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #f0f0f0;">
                                    </div>
                                    <div class="developer-social mt-3">
                                        <a href="https://linkedin.com/in/bungalestari" target="_blank"
                                            class="btn btn-primary btn-sm m-1" title="LinkedIn">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                        <a href="https://github.com/bungalestari" target="_blank"
                                            class="btn btn-dark btn-sm m-1" title="GitHub">
                                            <i class="mdi mdi-github"></i>
                                        </a>
                                        <a href="https://instagram.com/bunga.lestari" target="_blank"
                                            class="btn btn-danger btn-sm m-1" title="Instagram">
                                            <i class="mdi mdi-instagram"></i>
                                        </a>
                                        <a href="mailto:bunga24si@mahasiswa.pcr.ac.id" class="btn btn-info btn-sm m-1" title="Email">
                                            <i class="mdi mdi-email"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Informasi Identitas -->
                                <div class="col-md-5">
                                    <h5 class="font-weight-bold mb-3">Biodata Pengembang</h5>
                                    <div class="developer-info">
                                        <div class="mb-3">
                                            <p class="mb-1"><strong>Nama Lengkap:</strong> Bunga Lestari</p>
                                            <p class="mb-1"><strong>NIM:</strong> 2457301028</p>
                                            <p class="mb-1"><strong>Program Studi:</strong> Sistem Informasi</p>
                                            <p class="mb-1"><strong>Universitas:</strong> Politeknik Caltek Riau</p>
                                            <p class="mb-1"><strong>Email:</strong> bunga24si@mahasiswa.pcr.ac.id</p>
                                            <p class="mb-1"><strong>No. Telepon:</strong> +62 812-3456-7890</p>
                                        </div>

                                        <div class="mt-4">
                                            <h6 class="font-weight-bold mb-2">Keterangan:</h6>
                                            <p class="text-muted mb-0">
                                                Aplikasi ini dikembangkan sebagai tugas Framework di Semester 3 Politeknik
                                                Caltek Riau
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Proyek -->
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title font-weight-bold">Informasi Proyek</h6>
                                            <div class="project-info">
                                                <p class="mb-2"><strong>Nama Proyek:</strong> Sistem Bina Desa Fasilitas
                                                    Umum</p>
                                                <p class="mb-2"><strong>Mata Kuliah:</strong> Framework Pemrograman</p>
                                                <p class="mb-2"><strong>Semester:</strong> 3</p>
                                                <p class="mb-2"><strong>Teknologi:</strong></p>
                                                <ul class="list-unstyled mb-3">
                                                    <li><span class="badge badge-primary mr-1">Laravel</span></li>
                                                    <li><span class="badge badge-success mr-1">Bootstrap</span></li>
                                                    <li><span class="badge badge-info mr-1">MySQL</span></li>
                                                    <li><span class="badge badge-warning mr-1">JavaScript</span></li>
                                                </ul>
                                                <p class="mb-0"><strong>Status:</strong>
                                                    <span class="badge badge-success">Aktif</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 text-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                            data-target="#developerDetailModal">
                                            <i class="mdi mdi-information"></i> Detail Lengkap
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Pesanan & Laporan Penjualan -->
            <div class="row mt-4">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Detail Pesanan</p>
                            <p class="font-weight-500">Jumlah total sesi dalam rentang tanggal tersebut.
                                Ini adalah periode waktu pengguna aktif berinteraksi dengan situs web, halaman, atau
                                aplikasi Anda,dll</p>
                            <div class="d-flex flex-wrap mb-5">
                                <div class="mr-5 mt-3">
                                    <p class="text-muted">Nilai Pesanan</p>
                                    <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                                </div>
                                <div class="mr-5 mt-3">
                                    <p class="text-muted">Pesanan</p>
                                    <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                                </div>
                                <div class="mr-5 mt-3">
                                    <p class="text-muted">Pengguna</p>
                                    <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted">Unduhan</p>
                                    <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                                </div>
                            </div>
                            <canvas id="order-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="card-title">Laporan Penjualan</p>
                                <a href="#" class="text-info">Lihat Semua</a>
                            </div>
                            <p class="font-weight-500">Jumlah total sesi dalam rentang tanggal tersebut.
                                Ini adalah periode waktu pengguna aktif berinteraksi dengan situs web, halaman, atau
                                aplikasi Anda,dll.</p>
                            <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                            <canvas id="sales-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER KHUSUS DASHBOARD -->
            <div class="row mt-5">
                <div class="col-12">
                    <footer class="footer bg-light border-top py-4 mt-4">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <h5 class="font-weight-bold mb-3">
                                        <i class="fas fa-info-circle text-primary mr-2"></i>Informasi Sistem
                                    </h5>
                                    <p class="text-muted small">
                                        Sistem Bina Desa Fasilitas Umum adalah aplikasi untuk mengelola fasilitas dan data warga di tingkat desa secara digital.
                                    </p>
                                    <div class="d-flex mt-3">
                                        <a href="#" class="text-muted mr-3">
                                            <i class="fas fa-file-pdf mr-1"></i> Panduan
                                        </a>
                                        <a href="#" class="text-muted mr-3">
                                            <i class="fas fa-video mr-1"></i> Tutorial
                                        </a>
                                        <a href="#" class="text-muted">
                                            <i class="fas fa-question-circle mr-1"></i> FAQ
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3 mb-md-0">
                                    <h5 class="font-weight-bold mb-3">
                                        <i class="fas fa-link text-success mr-2"></i>Tautan Cepat
                                    </h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <a href="{{ route('warga.index') }}" class="text-muted">
                                                <i class="fas fa-users mr-2"></i>Data Warga
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ route('fasilitasumum.index') }}" class="text-muted">
                                                <i class="fas fa-building mr-2"></i>Fasilitas Umum
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="{{ route('user.index') }}" class="text-muted">
                                                <i class="fas fa-user-cog mr-2"></i>User Management
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-cog mr-2"></i>Pengaturan
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <h5 class="font-weight-bold mb-3">
                                        <i class="fas fa-id-card text-warning mr-2"></i>Kontak Pengembang
                                    </h5>
                                    <div class="contact-info">
                                        <p class="mb-2">
                                            <i class="fas fa-user-graduate mr-2"></i>
                                            <span class="font-weight-medium">Bunga Lestari</span>
                                        </p>
                                        <p class="mb-2">
                                            <i class="fas fa-university mr-2"></i>
                                            Politeknik Caltek Riau
                                        </p>
                                        <p class="mb-2">
                                            <i class="fas fa-envelope mr-2"></i>
                                            bunga24si@mahasiswa.pcr.ac.id
                                        </p>
                                        <div class="mt-3">
                                            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-sm mr-2">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <a href="mailto:bunga24si@mahasiswa.pcr.ac.id" class="btn btn-info btn-sm mr-2">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                            <a href="https://github.com/bungalestari" target="_blank" class="btn btn-dark btn-sm">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-village mr-1"></i>
                                        © 2025 RuangKu - Sistem Pengelolaan Fasilitas Desa
                                    </p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-heart text-danger mr-1"></i>
                                        Dibangun dengan semangat desa
                                    </p>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <!-- END FOOTER KHUSUS DASHBOARD -->

        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- Main Content -->

    <!-- Developer Detail Modal -->
    <div class="modal fade" id="developerDetailModal" tabindex="-1" role="dialog"
        aria-labelledby="developerDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="developerDetailModalLabel">Detail Lengkap Pengembang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('assets-admin/images/WhatsApp Image 2025-05-24 at 20.44.53_17f0cf70.jpg') }}"
                                alt="Foto Bunga Lestari" class="img-fluid rounded-circle mb-3"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            <h5>Bunga Lestari</h5>
                            <p class="text-muted">NIM: 2457301028</p>
                        </div>
                        <div class="col-md-8">
                            <h6 class="font-weight-bold mb-3">Biodata Lengkap</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Program Studi:</strong><br>Sistem Informasi</p>
                                    <p><strong>Universitas:</strong><br>Politeknik Caltek Riau</p>
                                    <p><strong>Email:</strong><br>bunga24si@mahasiswa.pcr.ac.id</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Telepon:</strong><br>+62 812-3456-7890</p>
                                    <p><strong>NIM:</strong><br>2457301028</p>
                                    <p><strong>Semester:</strong><br>Semester 3</p>
                                </div>
                            </div>

                            <h6 class="font-weight-bold mt-4 mb-3">Keterangan Proyek</h6>
                            <p class="text-justify">
                                Aplikasi Sistem Bina Desa Fasilitas Umum ini dikembangkan sebagai tugas mata kuliah
                                <strong>Framework Pemrograman Semester 3</strong> di Politeknik Caltek Riau.
                                Tujuan aplikasi ini adalah untuk mendigitalisasi administrasi dan pengelolaan
                                fasilitas umum di tingkat desa, serta meningkatkan transparansi pelayanan publik.
                            </p>

                            <h6 class="font-weight-bold mt-4 mb-3">Teknologi yang Digunakan</h6>
                            <div class="d-flex flex-wrap">
                                <span class="badge badge-primary m-1 p-2">Laravel 9</span>
                                <span class="badge badge-success m-1 p-2">Bootstrap 5</span>
                                <span class="badge badge-info m-1 p-2">MySQL</span>
                                <span class="badge badge-warning m-1 p-2">JavaScript</span>
                                <span class="badge badge-secondary m-1 p-2">jQuery</span>
                                <span class="badge badge-dark m-1 p-2">Chart.js</span>
                                <span class="badge badge-danger m-1 p-2">Font Awesome</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h6 class="font-weight-bold mb-3">Kontak & Media Sosial</h6>
                            <div class="text-center">
                                <a href="https://linkedin.com/in/bungalestari" target="_blank"
                                    class="btn btn-primary btn-sm m-1">
                                    <i class="mdi mdi-linkedin"></i> LinkedIn
                                </a>
                                <a href="https://github.com/bungalestari" target="_blank"
                                    class="btn btn-dark btn-sm m-1">
                                    <i class="mdi mdi-github"></i> GitHub
                                </a>
                                <a href="https://instagram.com/bunga.lestari" target="_blank"
                                    class="btn btn-danger btn-sm m-1">
                                    <i class="mdi mdi-instagram"></i> Instagram
                                </a>
                                <a href="mailto:bunga24si@mahasiswa.pcr.ac.id" class="btn btn-info btn-sm m-1">
                                    <i class="mdi mdi-email"></i> Email
                                </a>
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success btn-sm m-1">
                                    <i class="mdi mdi-whatsapp"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="font-weight-bold mb-2">Catatan:</h6>
                                    <p class="mb-0">
                                        <strong>Proyek ini merupakan bagian dari tugas mata kuliah Framework Pemrograman
                                            Semester 3
                                            di Politeknik Caltek Riau dengan fokus pada peningkatan sistem administrasi desa
                                            melalui teknologi informasi.</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Layout yang lebih rapi untuk bagian atas */
        .tale-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
        }

        .card-people {
            position: relative;
            height: 100%;
            min-height: 300px;
        }

        .card-people img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .weather-info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-width: 180px;
        }

        .weather-info h2 {
            color: #2c3e50;
            font-weight: 600;
        }

        .weather-info .location {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 0;
        }

        .weather-info h6 {
            color: #6c757d;
            margin-bottom: 0;
        }

        /* Statistics Cards Styling */
        .grid-margin.transparent .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .grid-margin.transparent .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .card-tale {
            background: linear-gradient(135deg, #FF9A9E 0%, #FAD0C4 100%);
            color: white;
        }

        .card-dark-blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .card-light-blue {
            background: linear-gradient(135deg, #4ECDC4 0%, #45B7D1 100%);
            color: white;
        }

        .card-light-danger {
            background: linear-gradient(135deg, #FF6B6B 0%, #EE5A24 100%);
            color: white;
        }

        .fs-30 {
            font-size: 30px;
            font-weight: 700;
        }

        /* Fitur Utama & Master Data Styling */
        .card-header.bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        .card-header.bg-gradient-success {
            background: linear-gradient(135deg, #06D6A0 0%, #1DD1A1 100%) !important;
        }

        .icon-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .border-left-primary { border-left-color: #667eea !important; }
        .border-left-success { border-left-color: #06D6A0 !important; }
        .border-left-info { border-left-color: #4ECDC4 !important; }
        .border-left-warning { border-left-color: #FFD166 !important; }
        .border-left-danger { border-left-color: #FF6B6B !important; }
        .border-left-secondary { border-left-color: #6c757d !important; }

        .bg-danger-light { background-color: rgba(255, 107, 107, 0.1) !important; }
        .bg-warning-light { background-color: rgba(255, 209, 102, 0.1) !important; }
        .bg-success-light { background-color: rgba(6, 214, 160, 0.1) !important; }

        .stat-box {
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            background-color: rgba(0,0,0,0.05) !important;
        }

        /* Hover Effects */
        .card.border-left-3 {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .card.border-left-3:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Data Statistik Styling */
        .grid-margin.stretch-card .card {
            transition: all 0.3s ease;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .grid-margin.stretch-card .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .grid-margin.stretch-card .card .progress {
            height: 6px;
            border-radius: 3px;
            background: rgba(255,255,255,0.3);
        }

        .grid-margin.stretch-card .card .progress-bar {
            border-radius: 3px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .weather-info {
                min-width: 150px;
                padding: 10px;
            }

            .weather-info h2 {
                font-size: 1.5rem;
            }

            .fs-30 {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .card-people {
                min-height: 200px;
            }

            .weather-info {
                bottom: 10px;
                left: 10px;
            }
        }

        /* Styling untuk bagian lain yang sudah ada */
        .slideshow-header {
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #007bff;
            margin-bottom: 20px;
        }

        .slideshow-header h3 {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .slideshow-header p {
            color: #6c757d;
            font-size: 1rem;
        }

        .slideshow-count .badge {
            font-size: 0.9rem;
            padding: 8px 15px;
            border-radius: 20px;
            background: linear-gradient(135deg, #007bff, #0056b3);
        }

        /* Carousel styling */
        .carousel {
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .carousel-image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                rgba(0, 0, 0, 0.1) 0%,
                rgba(0, 0, 0, 0.3) 70%,
                rgba(0, 0, 0, 0.7) 100%);
            z-index: 1;
        }

        .carousel-caption {
            position: absolute;
            bottom: 60px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 90%;
            max-width: 800px;
            z-index: 2;
            padding: 0;
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate(-50%, 20px);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }

        .caption-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 25px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .caption-title {
            color: #2c3e50;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: none;
        }

        .caption-description {
            color: #5a6c7d;
            font-size: 1.1rem;
            margin-bottom: 20px;
            text-shadow: none;
        }

        /* Developer styling */
        .developer-photo {
            transition: transform 0.3s ease;
        }

        .developer-photo:hover {
            transform: scale(1.05);
        }

        .developer-social .btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            transition: transform 0.2s ease;
        }

        .developer-social .btn:hover {
            transform: translateY(-3px);
        }

        /* Footer styling */
        .footer {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }

        .footer .btn-sm:hover {
            transform: scale(1.1);
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi carousel
            $('#indonesiaCarousel').carousel({
                interval: 5000,
                pause: 'hover',
                wrap: true
            });

            // Update indicator dots
            $('#indonesiaCarousel').on('slide.bs.carousel', function (e) {
                var nextSlide = e.to;
                $('.indicator-dot').removeClass('active');
                $('.indicator-dot').eq(nextSlide).addClass('active');
            });

            // Hover effect for feature cards
            $('.card.border-left-3').hover(
                function() {
                    $(this).css({
                        'transform': 'translateY(-3px)',
                        'box-shadow': '0 10px 20px rgba(0,0,0,0.1)'
                    });
                },
                function() {
                    $(this).css({
                        'transform': 'translateY(0)',
                        'box-shadow': 'none'
                    });
                }
            );

            // Hover effect for statistics cards
            $('.grid-margin.transparent .card, .grid-margin.stretch-card .card').hover(
                function() {
                    $(this).css({
                        'transform': 'translateY(-5px)',
                        'box-shadow': '0 10px 20px rgba(0,0,0,0.15)'
                    });
                },
                function() {
                    $(this).css({
                        'transform': 'translateY(0)',
                        'box-shadow': '0 4px 6px rgba(0,0,0,0.1)'
                    });
                }
            );
        });
    </script>
@endpush
