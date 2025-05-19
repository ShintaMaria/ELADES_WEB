<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <img src="{{ asset('landingpage/assets/img/logonavbar.png')}}" alt="" width="70" height="auto">
        <div class="sidebar-brand-text mx-3">Kauman <br> Nganjuk</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Layanan Administrasi</div>

    <!-- Pembuatan Surat -->
    @php
        $suratRoutes = ['skck', 'kehilangan', 'sktm', 'penghasilan', 'izinkerja', 'keramaian'];
    @endphp
    <li class="nav-item {{ request()->routeIs(...$suratRoutes) ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs(...$suratRoutes) ? '' : 'collapsed' }}"
           href="#" data-toggle="collapse" data-target="#collapsePembuatanSurat"
           aria-expanded="{{ request()->routeIs(...$suratRoutes) ? 'true' : 'false' }}"
           aria-controls="collapsePembuatanSurat">
            <i class="fas fa-envelope"></i>
            <span>Pembuatan Surat</span>
        </a>
        <div id="collapsePembuatanSurat" class="collapse {{ request()->routeIs(...$suratRoutes) ? 'show' : '' }}">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Surat Pengantar</h6>
                <a class="collapse-item {{ request()->routeIs('skck') ? 'active' : '' }}" href="{{ route('skck') }}">Pengantar SKCK</a>
                <a class="collapse-item {{ request()->routeIs('kehilangan') ? 'active' : '' }}" href="{{ route('kehilangan') }}">Kehilangan Barang</a>
                <h6 class="collapse-header">Surat Keterangan</h6>
                <a class="collapse-item {{ request()->routeIs('sktm') ? 'active' : '' }}" href="{{ route('sktm') }}">Pengantar SKTM</a>
                <a class="collapse-item {{ request()->routeIs('penghasilan') ? 'active' : '' }}" href="{{ route('penghasilan') }}">Keterangan Penghasilan</a>
                <h6 class="collapse-header">Surat Izin</h6>
                <a class="collapse-item {{ request()->routeIs('izinkerja') ? 'active' : '' }}" href="{{ route('izinkerja') }}">Izin Tidak Masuk Kerja</a>
                <a class="collapse-item {{ request()->routeIs('keramaian') ? 'active' : '' }}" href="{{ route('keramaian') }}">Izin Keramaian</a>
            </div>
        </div>
    </li>

    <!-- Laporan Pengajuan Surat -->
    <li class="nav-item {{ request()->routeIs('laporan_pengajuan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan_pengajuan') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Laporan Pengajuan Surat</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Layanan Aspirasi</div>

    <!-- Pengaduan -->
    @php
        $aduanRoutes = ['infrastruktur', 'keamanan', 'saran'];
    @endphp
    <li class="nav-item {{ request()->routeIs(...$aduanRoutes) ? 'active' : '' }}">
        <a class="nav-link {{ request()->routeIs(...$aduanRoutes) ? '' : 'collapsed' }}"
           href="#" data-toggle="collapse" data-target="#collapseInsfrastruktur"
           aria-expanded="{{ request()->routeIs(...$aduanRoutes) ? 'true' : 'false' }}"
           aria-controls="collapseInsfrastruktur">
            <i class="fas fa-bullhorn"></i>
            <span>Pengaduan Masyarakat</span>
        </a>
        <div id="collapseInsfrastruktur" class="collapse {{ request()->routeIs(...$aduanRoutes) ? 'show' : '' }}">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('infrastruktur') ? 'active' : '' }}" href="{{ route('infrastruktur') }}">Pengaduan Infrastruktur</a>
                <a class="collapse-item {{ request()->routeIs('keamanan') ? 'active' : '' }}" href="{{ route('keamanan') }}">Pengaduan Keamanan</a>
                <a class="collapse-item {{ request()->routeIs('saran') ? 'active' : '' }}" href="{{ route('saran') }}">Saran</a>
            </div>
        </div>
    </li>

    <!-- Laporan Pengaduan -->
    <li class="nav-item {{ request()->routeIs('laporan_pengaduan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan_pengaduan') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Laporan Pengaduan</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Informasi</div>

    <!-- Kabar Desa -->
    <li class="nav-item {{ request()->routeIs('kabardesa') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kabardesa') }}">
            <i class="fas fa-newspaper"></i>
            <span>Kabar Desa</span>
        </a>
    </li>

    <!-- Artikel -->
    <li class="nav-item {{ request()->routeIs('artikel') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('artikel') }}">
            <i class="fas fa-book-open"></i>
            <span>Artikel Terkini</span>
        </a>
    </li>

    <!-- Statistik -->
    <li class="nav-item {{ request()->routeIs('statistik') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('statistik') }}">
            <i class="fas fa-chart-bar"></i>
            <span>Data Statistik</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
