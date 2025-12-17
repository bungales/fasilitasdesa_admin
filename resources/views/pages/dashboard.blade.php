@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold">Welcome Bunga Lestari</h3>
                            <h6 class="font-weight-normal mb-0">Selamat Datang Projek bina desa saya fasilitas
                                desa
                                <span class="text-primary"> fasilitas umum admin!</span>
                            </h6>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="justify-content-end d-flex">
                                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                        id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true">
                                        <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                        <a class="dropdown-item" href="#">January - March</a>
                                        <a class="dropdown-item" href="#">March - June</a>
                                        <a class="dropdown-item" href="#">June - August</a>
                                        <a class="dropdown-item" href="#">August - November</a>
                                    </div>
                                    <a href="{{ route('login.destroy') }}" class="btn btn-danger btn-sm">
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card tale-bg">
                        <div class="card-people mt-auto">
                            <img src="{{ asset('assets-admin/images/dashboard/people.svg') }}" alt="people">
                            <div class="weather-info">
                                <div class="d-flex">
                                    <div>
                                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup>
                                        </h2>
                                    </div>
                                    <div class="ml-2">
                                        <h4 class="location font-weight-normal">Bangalore</h4>
                                        <h6 class="font-weight-normal">India</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin transparent">
                    <div class="row">
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-tale">
                                <div class="card-body">
                                    <p class="mb-4">Today's Bookings</p>
                                    <p class="fs-30 mb-2">4006</p>
                                    <p>10.00% (30 days)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 stretch-card transparent">
                            <div class="card card-dark-blue">
                                <div class="card-body">
                                    <p class="mb-4">Total Bookings</p>
                                    <p class="fs-30 mb-2">61344</p>
                                    <p>22.00% (30 days)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                            <div class="card card-light-blue">
                                <div class="card-body">
                                    <p class="mb-4">Number of Meetings</p>
                                    <p class="fs-30 mb-2">34040</p>
                                    <p>2.00% (30 days)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 stretch-card transparent">
                            <div class="card card-light-danger">
                                <div class="card-body">
                                    <p class="mb-4">Number of Clients</p>
                                    <p class="fs-30 mb-2">47033</p>
                                    <p>0.22% (30 days)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ======================= -->
            <!-- IDENTITAS PENGEMBANG - DIPINDAHKAN KE ATAS -->
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
                                            class="btn btn-primary btn-sm m-1">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>
                                        <a href="https://github.com/bungalestari" target="_blank"
                                            class="btn btn-dark btn-sm m-1">
                                            <i class="mdi mdi-github"></i>
                                        </a>
                                        <a href="https://instagram.com/bunga.lestari" target="_blank"
                                            class="btn btn-danger btn-sm m-1">
                                            <i class="mdi mdi-instagram"></i>
                                        </a>
                                        <a href="mailto:bunga24si@mahasiswa.pcr.ac.id" class="btn btn-info btn-sm m-1">
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
                                                Aplikasi ini dikembangkan sebagai tugas Framework di Semester 3politeknik
                                                caltek riau
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
            <!-- ======================= -->
            <!-- END IDENTITAS PENGEMBANG -->
            <!-- ======================= -->

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Order Details</p>
                            <p class="font-weight-500">Jumlah total sesi dalam rentang tanggal tersebut.
                                Ini adalah periode waktu pengguna aktif berinteraksi dengan situs web, halaman, atau
                                aplikasi Anda,dll</p>
                            <div class="d-flex flex-wrap mb-5">
                                <div class="mr-5 mt-3">
                                    <p class="text-muted">Order value</p>
                                    <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                                </div>
                                <div class="mr-5 mt-3">
                                    <p class="text-muted">Orders</p>
                                    <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                                </div>
                                <div class="mr-5 mt-3">
                                    <p class="text-muted">Users</p>
                                    <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted">Downloads</p>
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
                                <p class="card-title">Sales Report</p>
                                <a href="#" class="text-info">View all</a>
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
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-building mr-2"></i>Fasilitas Umum
                                            </a>
                                        </li>
                                        <li class="mb-2">
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-chart-bar mr-2"></i>Laporan
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
        }

        .developer-info p {
            margin-bottom: 8px;
            color: #555;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .card-title {
            color: #2c3e50;
            font-weight: 600;
        }

        .project-info ul li {
            display: inline-block;
        }

        /* Styling untuk footer dashboard */
        .footer {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }

        .footer h5 {
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .footer a.text-muted:hover {
            color: #007bff !important;
            text-decoration: none;
        }

        .footer .contact-info p {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .footer .btn-sm {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .developer-photo img {
                width: 120px !important;
                height: 120px !important;
            }

            .footer {
                text-align: center;
            }

            .footer .text-right {
                text-align: center !important;
                margin-top: 10px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Tambahkan efek hover pada tombol sosial media
            $('.developer-social .btn').hover(
                function() {
                    $(this).css('transform', 'translateY(-3px)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                }
            );

            // Animasi untuk tombol footer
            $('.footer .btn-sm').hover(
                function() {
                    $(this).css('transform', 'scale(1.1)');
                },
                function() {
                    $(this).css('transform', 'scale(1)');
                }
            );
        });
    </script>
@endpush
