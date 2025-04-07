@extends('dashboard/layouts.template')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800 text-center">Edit Data Statistik Desa Kauman</h1>

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="{{ route('statistik.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- total jiwa -->
                                <div class="form-group">
                                    <label for="total_jiwa">Total Jiwa</label>
                                    <input type="number" name="total_jiwa" id="total_jiwa" class="form-control" value="{{ old('total_jiwa', $statistik->total_jiwa ?? '') }}" required>
                                </div>

                                <!-- jumlah kk -->
                                <div class="form-group">
                                    <label for="jumlah_kk">Jumlah KK</label>
                                    <input type="number" name="jumlah_kk" id="jumlah_kk" class="form-control" value="{{ old('jumlah_kk', $statistik->jumlah_kk ?? '') }}" required>
                                </div>

                                <!-- jumlah dusun -->
                                <div class="form-group">
                                    <label for="jumlah_dusun">Jumlah Dusun</label>
                                    <input type="number" name="jumlah_dusun" id="jumlah_dusun" class="form-control" value="{{ old('jumlah_dusun', $statistik->jumlah_dusun ?? '') }}" required>
                                </div>

                                <!-- luas wilayah -->
                                <div class="form-group">
                                    <label for="luas_wilayah">Luas Wilayah (km²)</label>
                                    <input type="number" step="0.01" name="luas_wilayah" id="luas_wilayah" class="form-control" value="{{ old('luas_wilayah', $statistik->luas_wilayah ?? '') }}" required>
                                </div>

                                <!-- tombol simpan -->
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-save mr-2"></i>Simpan
                                    </button>
                                    <a href="{{ route('statistik') }}" class="btn btn-secondary px-4 ml-2">Batal</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
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
