<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Desa Kauman Nganjuk</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('landingpage/assets/img/logonavbar.png')}}" rel="icon">
  <link href="{{ asset('landingpage/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('landingpage/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('landingpage/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('landingpage/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('landingpage/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('landingpage/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- <img src="{{ asset('landingpage/assets/img/desa.jpeg') }}" alt="Gambar Desa"> -->
  <!-- Main CSS File -->
  <link href="{{ asset('landingpage/assets/css/main.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <!-- <img src="{{ asset('landingpage/assets/img/desa.jpeg') }}" alt="Gambar Desa"> -->
  <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

@include('landingpage/layouts.navbar')

  <main class="main">
  @yield('content')
  
  </main>

  <footer id="footer" class="footer bg-white text-dark py-4">
  <div class="container">
    <div class="row align-items-center">

      <!-- Kolom Kiri: Logo -->
      <div class="col-md-4 d-flex align-items-center mb-3 mb-md-0">
      <img src="landingpage/assets/img/logonavbar.png" alt="Logo Desa Kauman" style="width: 110px; height: auto; margin-right: 15px;">
        <div>
        <h2 class="mb-0 fw-bold text-uppercase" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
        DESA KAUMAN</h2>

          <p class="fs-6 fw-bold mb-0">KECAMATAN NGANJUK</p>
        </div>
      </div>

      <!-- Kolom Tengah Kosong -->
      <div class="col-md-4 text-center mb-3 mb-md-0">
        <!-- <p> Membangun desa menuju masyarakat sejahtera</p> -->
      </div>

      <!-- Kolom Kanan: Kontak -->
      <div class="col-md-4 text-md-end">
          <p class="mb-1">Jalan Gatot Subroto No. 100</p>
          <p class="mb-1">Kabupaten Nganjuk, Jawa Timur</p>
          <p class="mb-1"><i class="bi bi-telephone"></i> 0812-3595-3512</p>
          <p class="mb-1"><i class="bi bi-envelope"></i> kelurahankaumannganjuk@gmail.com</p>
        </div>

    </div>

    <!-- Baris Sosial Media -->
    <div class="row mt-3">
        <div class="col text-center">
          <div class="social-links d-flex justify-content-center mt-2">
            <a href="mailto:kelurahankaumannganjuk@gmail.com" class="me-3"><i class="bi bi-envelope fs-5"></i></a>
            <a href="https://www.instagram.com/kelurahankaumannganjuk?igsh=azdqZzN3NnBleDl4" class="me-3"><i class="bi bi-instagram fs-5"></i></a>
            <a href="https://wa.me/6281235953512" class="me-3"><i class="bi bi-whatsapp fs-5"></i></a>
          </div>
        </div>
      </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">B1ONE TEAM</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('landingpage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('landingpage/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{ asset('landingpage/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('landingpage/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('landingpage/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('landingpage/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('landingpage/assets/js/main.js')}}"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/purecounterjs@1.5.0/dist/purecounter_vanilla.js"></script>


  <!-- agar tidak bisa di back setelah logout -->
  <script>
    window.history.pushState(null, document.title, window.location.href);
    window.history.back();
    window.history.forward();
</script>


</body>

</html>