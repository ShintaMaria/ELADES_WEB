<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - Kauman Nganjuk</title>
    <link href="{{ asset('dashboard/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            background: url("{{ asset('landingpage/assets/img/nganjuk.jpg') }}") no-repeat center center fixed;
            background-size: cover;
        }
        .reset-container {
            margin-top: 100px;
        }
        .card {
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container reset-container">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('dashboard/assets/img/balai.png') }}" alt="Logo" width="200">
                    <h2 class="h5 text-gray-900 mt-3">Reset Password</h2>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="{{ $email }}" disabled>
                        <input type="hidden" name="email" value="{{ $email }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Reset Password
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a class="small" href="{{ route('login') }}">Kembali ke Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
