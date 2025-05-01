@extends('landingpage/layouts.template')
@section('content')


    <!-- Hero Section -->
    <section id="hero" class="hero section">

<div class="container" data-aos="fade-up" data-aos-delay="100">

  <div class="row align-items-center">
    <div class="col-lg-6">
      <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
        <h1 class="mb-2">
          <span class="accent-text">Desa Kauman</span>
        </h1>
        <h3>
          <span class="accent-text">Kec.Nganjuk, Kab.Nganjuk, Provinsi Jawa Timur</span>
        </h3>
        <p class="mb-4 mb-md-5 custom-text">
        Selamat datang di Website Resmi Desa Kauman. Temukan informasi terbaru, layanan administrasi, serta potensi Desa Kauman. Bersama, kita wujudkan desa yang maju, dan sejahtera!
        </p>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
        <div class="customers-badge">
          <h4 class="fw-bold mb-2">Jadwal Pelayanan</h4>
          <h5 class="mb-3">Kantor Desa Kauman</h5>
          <div class="schedule-box jadwal-box p-1  text-center">
            <div class="row">
              <div class="col">
                <span class="fw-bold">Buka</span>
                <div class="fs-7">08.00 WIB</div>
              </div>
              <div class="col">
                <span class="fw-bold">Tutup</span>
                <div class="fs-7">16.00 WIB</div>
              </div>
              <div class="col">
                <span class="fw-bold">Libur</span>
                <div class="fs-7">Sabtu-Minggu</div>
              </div>
            </div>
           </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row stats-row gy-2 mt-3" data-aos="fade-up" data-aos-delay="500">
    <div class="col-lg-3 col-md-6">
      <div class="stat-item">
        <div class="stat-icon">
          <i class="bi bi-people"></i>
        </div>
        <div class="stat-content">
          <p class="mb-2 fw-bold">Total Jiwa</p>
          <h2><span data-purecounter-start="0" data-purecounter-end="{{ $statistik->total_jiwa ?? 0 }}" data-purecounter-duration="2" class="purecounter"></span></h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="stat-item">
        <div class="stat-icon">
          <i class="bi bi-house-door"></i>
        </div>
        <div class="stat-content">
          <p class="mb-2 fw-bold">Jumlah KK</p>
          <h2><span data-purecounter-start="0" data-purecounter-end="{{ $statistik->jumlah_kk ?? 0 }}" data-purecounter-duration="2" class="purecounter"></span></h2>   
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="stat-item">
        <div class="stat-icon">
          <i class="bi bi-map"></i>
        </div>
        <div class="stat-content">
        <p class="mb-2 fw-bold">Jumlah Dusun</p>
        <h2><span data-purecounter-start="0" data-purecounter-end="{{ $statistik->jumlah_dusun ?? 0 }}" data-purecounter-duration="2" class="purecounter"></span></h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="stat-item">
        <div class="stat-icon">
          <i class="bi bi-rulers"></i>
        </div>
        <div class="stat-content">
          <p class="mb-2 fw-bold">Luas Wilayah</p>
          <h2><span data-purecounter-start="0" data-purecounter-end="{{ $statistik->luas_wilayah ?? 0 }}" data-purecounter-duration="2" class="purecounter"></span> km²</h2>
        </div>
      </div>
    </div>
  </div>

</div>
</section><!-- /Hero Section -->




    <!-- About Section -->
<section id="struktur" class="about section text-center pt-0">
<div class="container" data-aos="fade-up" data-aos-delay="100">
  <!-- Judul di tengah atas -->
  <div class="row justify-content-center">
    <div class="col-12">
      <h1><span class="about-meta">Struktur Organisasi Desa Kauman</span></h1>
    </div>
  </div>
  <!-- Gambar full kanan dan kiri -->
  <div class="row justify-content-center mt-4">
    <div class="col-12" data-aos="fade-up" data-aos-delay="300">
      <div class="image-wrapper">
        <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
          <img src="{{ asset('landingpage/assets/img/strukturr.jpg') }}" alt="Struktur Organisasi" class="img-fluid w-100 rounded-4">
        </div>
      </div>
    </div>
  </div>
</div>
</section><!-- /About Section -->




    <!-- Features Section -->
    <section id="features" class="features section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>VISI & MISI Desa Kauman</h2>
      </div><!-- End Section Title -->
      <div class="container">
        <div class="d-flex justify-content-center">
          <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
            <li class="nav-item">
              <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                <h4>VISI</h4>
              </a>
            </li><!-- End tab nav item -->
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                <h4>MISI</h4>
              </a><!-- End tab nav item -->
            </li>
          </ul>
        </div>
        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
          <div class="tab-pane fade active show" id="features-tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Visi Desa Kauman</h3>
                <p class="fst-italic">
                "Mewujudkan pelayanan desa yang modern, cepat, dan transparan melalui digitalisasi untuk meningkatkan kesejahteraan masyarakat"
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('landingpage/assets/img/satu.jpg')}}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End tab content item -->
          <div class="tab-pane fade" id="features-tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Misi Desa Kauman</h3>
                <ul>
                  <li><i class="bi bi-check2-all"></i> <span>Mengembangkan sistem administrasi desa berbasis digital untuk kemudahan pelayanan masyarakat.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Meningkatkan efisiensi dan transparansi dalam pengelolaan layanan publik desa.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Mendorong partisipasi masyarakat dalam memanfaatkan teknologi untuk kebutuhan administratif.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Menyediakan informasi desa yang mudah diakses dan selalu diperbarui.</span></li>
                  <li><i class="bi bi-check2-all"></i> <span>Memanfaatkan teknologi sebagai sarana inovasi dalam pembangunan desa yang lebih maju dan responsif.</span></li>
                </ul>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="{{ asset('landingpage/assets/img/dua.jpg')}}" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End tab content item -->
        </div>
      </div>
    </section><!-- /Features Section -->



    
    <!-- Features Cards Section -->
    <section id="features-cards" class="features-cards section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="feature-box orange">
              <i class="bi bi-file-earmark-text"></i>
              <h4>Pelayanan Administrasi</h4>
              <p>Ajukan surat keterangan, izin usaha, dan dokumen kependudukan dengan mudah secara online.</p>
            </div>
          </div><!-- End Feature Borx-->

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="feature-box blue">
              <i class="bi bi-newspaper"></i>
              <h4>Informasi Publik</h4>
              <p>Dapatkan berita terbaru dan pengumuman penting desa.</p>
            </div>
          </div><!-- End Feature Borx-->

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="feature-box green">
              <i class="bi bi-people"></i>
              <h4>Program & Kegiatan</h4>
              <p>Ikuti berbagai program pembangunan, pemberdayaan masyarakat, dan kegiatan sosial di desa.</p>
            </div>
          </div><!-- End Feature Borx-->

          <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="feature-box red">
              <i class="bi bi-exclamation-triangle"></i>
              <h4>Keamanan & Pengaduan</h4>
              <p>Laporkan masalah keamanan, infrastruktur, atau layanan desa melalui sistem pengaduan online.</p>
            </div>
          </div><!-- End Feature Borx-->

        </div>

      </div>

    </section><!-- /Features Cards Section -->

    

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      
    <!-- Features 2 Section -->

      <section id="features-2" class="features-2 section">
        <div class="container section-title" data-aos="fade-up">
          <h2>Aplikasi E-Lades – Solusi Pelayanan Desa dalam Genggaman</h2>
           <p>Dapatkan layanan administrasi desa, pengaduan masyarakat, dan informasi terkini langsung dari aplikasi E-Lades. Praktis, cepat, dan mudah!</p>
        
        </div><!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-center">

            <div class="col-lg-4">

              <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="200">
                <div class="d-flex align-items-center justify-content-end gap-4">
                  <div class="feature-content">
                    <h3>Pengajuan Surat Online</h3>
                    <p>Ajukan pembuatan surat melalui aplikasi tanpa perlu datang ke kantor desa.</p>
                  </div>
                  <div class="feature-icon flex-shrink-0">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
              </div>
            </div><!-- End .feature-item -->

            <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="300">
              <div class="d-flex align-items-center justify-content-end gap-4">
                <div class="feature-content">
                  <h3>Riwayat Pengajuan Surat</h3>
                  <p>Lihat status dan riwayat pengajuan surat secara lengkap, mulai dari permohonan hingga persetujuan, langsung di aplikasi.</p>
                </div>
                <div class="feature-icon flex-shrink-0">
                  <i class="bi bi-journal-check"></i>
                </div>
              </div>
            </div><!-- End .feature-item -->

      <div class="feature-item text-end" data-aos="fade-right" data-aos-delay="400">
        <div class="d-flex align-items-center justify-content-end gap-4">
          <div class="feature-content">
            <h3>Notifikasi & Pengumuman Desa</h3>
            <p>Dapatkan info terbaru tentang kegiatan dan kebijakan desa langsung melalui aplikasi.</p>
          </div>
          <div class="feature-icon flex-shrink-0">
            <i class="bi bi-bell"></i>
          </div>
        </div>
      </div><!-- End .feature-item -->

    </div>

    <style>
  .hero-buttons {
    margin-bottom: 30px; /* Menambah jarak antara tombol dan gambar */
  }
</style>

<div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
  <div class="phone-mockup text-center">
    <div class="hero-buttons">
    <a href="LINK_UNDuhan_APLIKASI" class="btn btn-success rounded me-0 me-sm-2 mx-1">
  <i class="fas fa-download"></i> Download Aplikasi
</a>
    </div>
    <div>
      <img src="{{ asset('landingpage/assets/img/phone.png')}}" 
           alt="Phone Mockup" class="img-fluid">
    </div>
  </div><!-- End Phone Mockup -->
</div>

    <div class="col-lg-4">

      <div class="feature-item mb-5" data-aos="fade-left" data-aos-delay="200">
        <div class="d-flex align-items-center gap-4">
          <div class="feature-icon flex-shrink-0">
            <i class="bi bi-exclamation-triangle"></i>
          </div>
          <div class="feature-content">
            <h3>Fitur Pengaduan Masyarakat </h3>
            <p>Laporkan permasalahan infrastruktur, keamanan, atau sampaikan saran untuk desa dengan mudah.<p>
          </div>
        </div>
      </div><!-- End .feature-item -->

      <div class="feature-item mb-5" data-aos="fade-left" data-aos-delay="300">
        <div class="d-flex align-items-center gap-4">
          <div class="feature-icon flex-shrink-0">
            <i class="bi bi-phone"></i>
          </div>
          <div class="feature-content">
            <h3>Desain Responsif & Modern</h3>
            <p>Tampilan ramah pengguna yang mudah diakses oleh semua kalangan masyarakat.</p>
          </div>
        </div>
      </div><!-- End .feature-item -->

      <div class="feature-item" data-aos="fade-left" data-aos-delay="400">
        <div class="d-flex align-items-center gap-4">
          <div class="feature-icon flex-shrink-0">
            <i class="bi bi-search"></i>
          </div>
          <div class="feature-content">
            <h3>Cek dan Lacak Status Pengajuan</h3>
            <p>Pantau status pengajuan surat atau pengaduan langsung melalui aplikasi tanpa perlu datang ke kantor desa.</p>
          </div>
        </div>
      </div><!-- End .feature-item -->

    </div>
  </div>
          

          
          

        

   

   <!-- Services Section -->
<section id="services" class="services section light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Artikel Terkini</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4">
            @foreach($artikels as $artikel)
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card d-flex">
                    <div class="icon flex-shrink-0">
                        <i class="bi-newspaper"></i>
                    </div>
                    <div>
                        <h3>{{ $artikel->judul }}</h3>
                        <p>{{ Str::limit($artikel->isi, 100) }}</p>
                        <a href="{{ $artikel->link }}" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div><!-- End Service Card -->
            @endforeach
        </div>
    </div>
</section><!-- /Services Section -->

    <!-- Faq Section -->
    <section class="faq-9 faq section light-background" id="faq">

      <div class="container">
        <div class="row">

          <div class="col-lg-5" data-aos="fade-up">
            <h2 class="faq-title">Pertanyaan Umum seputar Desa Kauman</h2>
            <p class="faq-description">Temukan jawaban atas pertanyaan yang sering diajukan mengenai layanan dan program desa.

</p>
            <div class="faq-arrow d-none d-lg-block" data-aos="fade-up" data-aos-delay="200">
              <svg class="faq-arrow" width="200" height="211" viewBox="0 0 200 211" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M198.804 194.488C189.279 189.596 179.529 185.52 169.407 182.07L169.384 182.049C169.227 181.994 169.07 181.939 168.912 181.884C166.669 181.139 165.906 184.546 167.669 185.615C174.053 189.473 182.761 191.837 189.146 195.695C156.603 195.912 119.781 196.591 91.266 179.049C62.5221 161.368 48.1094 130.695 56.934 98.891C84.5539 98.7247 112.556 84.0176 129.508 62.667C136.396 53.9724 146.193 35.1448 129.773 30.2717C114.292 25.6624 93.7109 41.8875 83.1971 51.3147C70.1109 63.039 59.63 78.433 54.2039 95.0087C52.1221 94.9842 50.0776 94.8683 48.0703 94.6608C30.1803 92.8027 11.2197 83.6338 5.44902 65.1074C-1.88449 41.5699 14.4994 19.0183 27.9202 1.56641C28.6411 0.625793 27.2862 -0.561638 26.5419 0.358501C13.4588 16.4098 -0.221091 34.5242 0.896608 56.5659C1.8218 74.6941 14.221 87.9401 30.4121 94.2058C37.7076 97.0203 45.3454 98.5003 53.0334 98.8449C47.8679 117.532 49.2961 137.487 60.7729 155.283C87.7615 197.081 139.616 201.147 184.786 201.155L174.332 206.827C172.119 208.033 174.345 211.287 176.537 210.105C182.06 207.125 187.582 204.122 193.084 201.144C193.346 201.147 195.161 199.887 195.423 199.868C197.08 198.548 193.084 201.144 195.528 199.81C196.688 199.192 197.846 198.552 199.006 197.935C200.397 197.167 200.007 195.087 198.804 194.488ZM60.8213 88.0427C67.6894 72.648 78.8538 59.1566 92.1207 49.0388C98.8475 43.9065 106.334 39.2953 114.188 36.1439C117.295 34.8947 120.798 33.6609 124.168 33.635C134.365 33.5511 136.354 42.9911 132.638 51.031C120.47 77.4222 86.8639 93.9837 58.0983 94.9666C58.8971 92.6666 59.783 90.3603 60.8213 88.0427Z" fill="currentColor"></path>
              </svg>
            </div>
          </div>

          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
            <div class="faq-container">

              <div class="faq-item faq-active">
                <h3>Bagaimana cara mengurus surat di Desa Kauman?</h3>
                <div class="faq-content">
                  <p>Pengurusan surat di Desa Kauman dapat dilakukan secara online melalui aplikasi mobile E-Lades atau offline dengan mengunjungi langsung kantor desa dan menemui admin yang bertugas.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apa saja program unggulan Desa Kauman?</h3>
                <div class="faq-content">
                  <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Jenis surat apa saja yang dapat di ajukan melalui aplikasi E-lades?</h3>
                <div class="faq-content">
                  <p>Jenis surat yang tersedia meliputi Surat Keterangan, seperti keterangan penghasilan orang tua dan Surat Keterangan Tidak Mampu (SKTM); Surat Izin, seperti izin tidak masuk kerja dan izin tempat usaha; serta Surat Pengantar, seperti pengantar SKCK dan pengantar kehilangan barang. Dengan adanya layanan ini, proses administrasi desa menjadi lebih efisien tanpa harus datang langsung ke kantor desa.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Bagaimana cara melakukan pengaduan desa?</h3>
                <div class="faq-content">
                  <p>Pengaduan desa dapat dilakukan melalui aplikasi mobile, yang menyediakan fitur khusus untuk pengaduan infrastruktur, pengaduan keamanan, serta saran dan masukan untuk desa.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Tempus quam pellentesque nec nam aliquam sem et tortor?</h3>
                <div class="faq-content">
                  <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Bagaimana cara mengetahui informasi atau pengumuman terbaru dari desa?</h3>
                <div class="faq-content">
                  <p> Informasi dan pengumuman terbaru dari Desa Kauman dapat diakses melalui fitur Kabar Desa di aplikasi mobile resmi desa.

</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>
          </div>

        </div>
      </div>
    </section><!-- /Faq Section -->
   

    <!-- Contact Section -->
    <section id="contact" class="contact section light-background">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Maps Desa Kauman</h2>
    <p>Berikut adalah alamat Kantor Desa Kauman, Nganjuk.</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="map-container" style="width: 100%; height: 400px;">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.81955339159!2d111.89245081002755!3d-7.594609075017216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e784afd7c743a65%3A0x1d2fe986afb87add!2sKantor%20Kelurahan%20Kauman!5e0!3m2!1sid!2sid!4v1743982002832!5m2!1sid!2sid"
        width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
      </iframe>
    </div>
  </div>
</section>
    </section><!-- /Contact Section -->



@endsection