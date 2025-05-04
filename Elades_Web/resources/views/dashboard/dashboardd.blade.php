@extends('dashboard/layouts.template')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <form action="#" method="GET" class="form-inline">
    <label class="mr-2">Filter:</label>
    <select name="filter" class="form-control mr-2" onchange="this.form.submit()">
        <option value="day" {{ $_GET['filter'] ?? '' == 'day' ? 'selected' : '' }}>Hari</option>
        <option value="week" {{ $_GET['filter'] ?? '' == 'week' ? 'selected' : '' }}>Minggu</option>
        <option value="month" {{ $_GET['filter'] ?? '' == 'month' ? 'selected' : '' }}>Bulan</option>
        <option value="year" {{ $_GET['filter'] ?? '' == 'year' ? 'selected' : '' }}>Tahun</option>
    </select>
</form>


                    </div>
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left-primary shadow" style="height: auto; min-height: 100px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1" style="font-size: 10px;">
                            Surat Masuk
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">14</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-envelope fa-sm text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left-success shadow" style="height: auto; min-height: 100px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-success text-uppercase mb-1" style="font-size: 10px;">
                            Surat Keluar
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">11</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paper-plane fa-sm text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Card Example -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left-info shadow" style="height: auto; min-height: 100px;">
        <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-success text-uppercase mb-1" style="font-size: 10px;">
                            Surat Ditolak
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times-circle fa-sm text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left-warning shadow" style="height: auto; min-height: 100px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-warning text-uppercase mb-1" style="font-size: 10px;">
                            Pengaduan Masuk
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-sm text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Users Card Example -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left-dark shadow" style="height: auto; min-height: 100px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-dark text-uppercase mb-1" style="font-size: 10px;">
                            Pengaduan Dalam Tindakan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">150</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tools fa-sm text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Sales Card (Patokan) -->
    <div class="col-xl-2 col-md-4 mb-2">
        <div class="card border-left-secondary shadow" style="height: auto; min-height: 100px;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1" style="font-size: 10px;">
                            Pengaduan Selesai
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">21</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-sm text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->

                                <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    var ctx = document.getElementById("myAreaChart").getContext("2d");

                                    var myAreaChart = new Chart(ctx, {
                                        type: "line",
                                        data: {
                                            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"], // Label bulan
                                            datasets: [
                                                {
                                                    label: "Surat Masuk",
                                                    data: [12, 19, 3, 5, 2, 3, 10, 15, 8, 6, 9, 4], // Data surat masuk
                                                    borderColor: " #6a9f73",
                                                    backgroundColor: "rgba(81, 255, 0, 0.3)", // Warna merah transparan
                                                    fill: true
                                                },
                                                {
                                                    label: "Pengaduan Masuk",
                                                    data: [8, 10, 5, 2, 14, 7, 9, 4, 6, 11, 13, 7], // Data pengaduan masuk
                                                    borderColor: " #e74a3b",
                                                    backgroundColor: "rgba(229, 255, 0, 0.3)", // Warna biru transparan
                                                    fill: true
                                                }
                                            ]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            scales: {
                                                x: {
                                                    grid: {
                                                        display: false
                                                    }
                                                },
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                });
                                </script>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('dashboard/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages -->
    <script src="{{ asset('dashboard/assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('dashboard/assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </body>

</html>
@endsection
