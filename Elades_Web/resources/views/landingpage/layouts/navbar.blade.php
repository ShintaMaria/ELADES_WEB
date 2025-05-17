<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <img src="{{ asset('landingpage/assets/img/logonavbar.png')}}" alt=""> 
        <h7 class="sitename">Desa Kauman <br> Kecamatan Nganjuk</h7>
      </a>

      <nav id="navmenu" class="navmenu ">
        <ul>
          <li><a href="#hero" class="active ">Home</a></li>
          <li class="dropdown"><a href=""><span>Detail</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#struktur">Struktur organisasi</a></li>
              <li><a href="#visimisi">Visi dan Misi</a></li>
              <li><a href="#aplikasi">Aplikasi E-Lades</a></li>
              <li><a href="#artikel">Artikel Terkini</a></li>
              <li><a href="#faq">Pertanyaan Umum</a></li>
              <li><a href="#maps">Maps Kauman</a></li>
            </ul>
          </li>
          <li><a href="#footer">Contact</a></li>
          <a href="{{ route('login') }}" class="btn-getstarted">Login Admin</a>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      
    </div>
  </header>