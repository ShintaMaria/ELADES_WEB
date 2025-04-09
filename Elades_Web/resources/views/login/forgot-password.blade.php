<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('landingpage/assets/img/logonavbar.png')}}" rel="icon">
    <title>Forgot Password - Kauman Nganjuk</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('dashboard/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('dashboard/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom style override -->
    <style>
        .forgot {
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

        .forgot::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("{{ asset('landingpage/assets/img/nganjuk.jpg') }}") no-repeat center center/cover;
            filter: brightness(70%);
            z-index: -1;
            pointer-events: none;
        }

        .card {
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>

<body class="forgot">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Card Body -->
                        <div class="p-5">
                            <div class="text-center">
                                <img src="{{ asset('dashboard/assets/img/balai.png') }}" alt="Logo" style="width: 210px; height: auto; margin-bottom: 20px;">
                                <h1 class="h4 text-gray-900 mb-2">Lupa Password?</h1>
                                <p class="mb-4">Silakan masukkan alamat email Anda di bawah ini, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda!</p>
                            </div>

                            {{-- Pesan sukses --}}
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Pesan error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="user" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Alamat Email..." required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Kirim Link ke Email
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Halaman Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
