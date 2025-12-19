<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                href="{{ route('dashboard.index') }}">
                <i class="fa-solid fa-gauge-high menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- FITUR UTAMA -->
        <li class="menu-section">Fitur Utama</li>

        <!-- Fasilitas Umum -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#fasilitas-umum">
                <i class="fa-solid fa-building menu-icon"></i>
                <span class="menu-title">Fasilitas Umum</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="fasilitas-umum">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('fasilitasumum.index') }}">Lihat Data</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('fasilitasumum.create') }}">Tambah Data</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Peminjaman Fasilitas -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#peminjaman-fasilitas">
                <i class="fa-solid fa-handshake menu-icon"></i>
                <span class="menu-title">Peminjaman Fasilitas</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="peminjaman-fasilitas">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('peminjaman.index') }}">Lihat Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('peminjaman.create') }}">Tambah Data</a>
                    </li>
                </ul>
            </div>
        </li>

         <!-- Pembayaran Fasilitas -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pembayaran-fasilitas">
                <i class="fa-solid fa-money-bill-wave menu-icon"></i>
                <span class="menu-title">Pembayaran Fasilitas</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pembayaran-fasilitas">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pembayaran.index') }}">Lihat Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pembayaran.create') }}">Tambah Data</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Syarat Fasilitas -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#syarat-fasilitas">
                <i class="fa-solid fa-clipboard-list menu-icon"></i>
                <span class="menu-title">Syarat Fasilitas</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="syarat-fasilitas">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('syarat-fasilitas.index') }}">Lihat Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('syarat-fasilitas.create') }}">Tambah Data</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Petugas Fasilitas -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#petugas-fasilitas">
                <i class="fa-solid fa-user-tie menu-icon"></i>
                <span class="menu-title">Petugas Fasilitas</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="petugas-fasilitas">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('petugas-fasilitas.index') }}">Lihat Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('petugas-fasilitas.create') }}">Tambah Data</a>
                    </li>
                </ul>
            </div>
        </li>



        <!-- MASTER DATA -->
        <li class="menu-section">Master Data</li>

        <!-- Data Warga -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#data-warga">
                <i class="fa-solid fa-people-group menu-icon"></i>
                <span class="menu-title">Data Warga</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="data-warga">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('warga.index') }}">Lihat Data</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('warga.create') }}">Tambah Data</a></li>
                </ul>
            </div>
        </li>

        <!-- User -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user">
                <i class="fa-solid fa-user-gear menu-icon"></i>
                <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}">Lihat Data</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.create') }}">Tambah Data</a></li>
                </ul>
            </div>
        </li>

    </ul>
</nav>
