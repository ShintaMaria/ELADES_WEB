<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('landingpage/assets/img/logonavbar.png')}}" alt=""> 
        <h7 class="sitename">Desa Kauman <br> Kecamatan Nganjuk</h7>
      </a>

      <nav id="navmenu" class="navmenu ">
        <ul>
          <li><a href="#hero" class="active ">Home</a></li>
          
          <!-- <li><a href="#services">Services</a></li> -->
          <li class="dropdown"><span>Detail</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#struktur">Struktur organisasi</a></li>
              <!-- <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                
              </li> -->
              <li><a href="#features">Visi dan Misi</a></li>
              <li><a href="#testimonials">Aplikasi E-Lades</a></li>
              <li><a href="#services">Artikel Terkini</a></li>
              <li><a href="#faq">Pertanyaan Umum</a></li>
              <li><a href="#contact">Maps Kauman</a></li>
            </ul>
          </li>
          <li><a href="#footer">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="navbar-buttons">
      <a href="{{ route('login') }}" class="btn btn-primary btn-success rounded-5">Login Admin</a> <!-- Tombol kecil -->
          
        </div>

    </div>
  </header>