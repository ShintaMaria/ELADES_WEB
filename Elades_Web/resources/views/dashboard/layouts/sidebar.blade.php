<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <img src="{{ asset('landingpage/assets/img/logonavbar.png')}}" alt="" width="70" height="auto">
        <div class="sidebar-brand-text mx-3">Kauman <br> Nganjuk</div>
    </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Layanan Administrasi</div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePembuatanSurat"
            aria-expanded="true" aria-controls="collapsePembuatanSurat">
            <i class="fas fa-envelope"></i>
            <span>Pembuatan Surat</span>
        </a>
        <div id="collapsePembuatanSurat" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Surat Pengantar</h6>
                <a class="collapse-item" href="{{ route('skck') }}">Pengantar SKCK</a>
                <a class="collapse-item" href="{{ route('kehilangan') }}">Kehilangan Barang</a>
                <h6 class="collapse-header">Surat Keterangan</h6>
                <a class="collapse-item" href="{{ route('sktm') }}">Pengantar SKTM</a>
                <a class="collapse-item" href="{{ route('penghasilan') }}">Keterangan Penghasilan</a>
                <h6 class="collapse-header">Surat Izin</h6>
                <a class="collapse-item" href="buttons.html">Izin Tidak Masuk Kerja</a>
                <a class="collapse-item" href="{{ route('keramaian') }}">Izin Keramaian</a>
            </div>
        </div>
    </li> <!-- Added missing closing tag -->

    <!-- Laporan Surat -->
    {{-- Donnz --}}
   <li class="nav-item">
        <a class="nav-link" href="{{ route('laporan_pengajuan') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Laporan Pengajuan Surat</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Layanan Aspirasi</div>

    <!-- Pengaduan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInsfrastruktur"
            aria-expanded="true" aria-controls="collapseInsfrastruktur">
            <i class="fas fa-bullhorn"></i>
            <span>Pengaduan Masyarakat</span>
        </a>
        <div id="collapseInsfrastruktur" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('infrastruktur') }}">Pengaduan Infrastruktur</a>
                <a class="collapse-item" href="{{ route('keamanan') }}">Pengaduan Keamanan</a>
                <a class="collapse-item" href="{{ route('saran') }}">Saran</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('laporan_pengaduan') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Laporan Pengaduan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Informasi</div>

    <!-- Kabar Desa -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kabardesa') }}">
            <i class="fas fa-newspaper"></i>
            <span>Kabar Desa</span>
        </a>
    </li>

    <!-- Artikel -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('artikel') }}">
            <i class="fas fa-book-open"></i>
            <span>Artikel Terkini</span>
        </a>
    </li>

    <!-- Statistik -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('statistik') }}">
            <i class="fas fa-chart-bar"></i>
            <span>Data Statistik</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
