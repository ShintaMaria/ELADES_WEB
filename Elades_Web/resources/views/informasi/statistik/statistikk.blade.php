@extends('dashboard/layouts.template')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
        <h1 style="margin-top: 0px;">Informasi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Statistik</li>
        </ol>

            <div class="row">

                <!-- Total Jiwa -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Jiwa</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($statistik->total_jiwa ?? 0) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jumlah KK -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah KK</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($statistik->jumlah_kk ?? 0) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-home fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Dusun -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Dusun</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($statistik->jumlah_dusun ?? 0) }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-map fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Luas Wilayah -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Luas Wilayah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ number_format($statistik->luas_wilayah ?? 0, 2) }} km²
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-ruler-combined fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- Tombol Edit di bawah tengah -->
            <div class="text-center mt-5 mb-5">
                <a href="{{ route('statistik.edit') }}" class="btn btn-primary btn-lg px-5 py-3 shadow rounded-pill">
                    <i class="fas fa-edit mr-2"></i>Perbarui Data Statistik Desa Kauman
                </a>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

<!-- Script JS -->
<script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/sb-admin-2.min.js')}}"></script>

@endsection
