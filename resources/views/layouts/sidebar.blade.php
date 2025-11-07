<ul class="nav flex-column">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>
    </li>

    <li class="nav-title mt-3">Master Data</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
            <i class="fa-solid fa-user-gear"></i> User
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('warga.index') }}">
            <i class="fa-solid fa-users"></i> Warga
        </a>
    </li>

    <li class="nav-title mt-3">Fasilitas Desa</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('fasilitasumum.index') }}">
            <i class="fa-solid fa-tree-city"></i> Fasilitas Umum
        </a>
    </li>

</ul>
