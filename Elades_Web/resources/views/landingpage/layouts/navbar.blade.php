<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('landingpage/assets/img/logonavbar.png')}}" alt=""> 
        <h7 class="sitename">Desa Kauman <br> Kecamatan Nganjuk</h7>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active ">Home</a></li>
          
          <!-- <li><a href="#services">Services</a></li> -->
          <li class="dropdown"><a href="#"><span>Detail</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Struktur organisasi</a></li>
              <!-- <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                
              </li> -->
              <li><a href="#">Visi dan Misi</a></li>
              <li><a href="#">Aplikasi E-Lades</a></li>
              <li><a href="#">Artikel Terkini</a></li>
              <li><a href="#">Pertanyaan Umum</a></li>
              <li><a href="#">Maps Kauman</a></li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div class="navbar-buttons">
      <a href="https://www.instagram.com/kelurahankaumannganjuk/" class="btn btn-primary btn-success rounded-5">Login Admin</a> <!-- Tombol kecil -->
          <!-- <a href="https://www.instagram.com/kelurahankaumannganjuk/" class="btn btn-primary me-0 me-sm-2 mx-1">Login Admin</a> -->
        </div>

    </div>
  </header>