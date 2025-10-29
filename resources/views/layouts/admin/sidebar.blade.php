
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    {{-- warga --}}
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#data-warga" aria-expanded="false"
                            aria-controls="data-warga">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Data Warga</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="data-warga">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('warga.index') }}">Lihat Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('warga.create') }}">Tambah Data</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- fasilitas umum --}}
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#fasilitas-umum" aria-expanded="false"
                            aria-controls="fasilitas-umum">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Fasilitas Umum</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="fasilitas-umum">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('fasilitasumum.index') }}">Lihat Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('fasilitasumum.create') }}">Tambah Data</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- user --}}
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false"
                            aria-controls="user">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">User </span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="user">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">Lihat Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.create') }}">Tambah Data</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
