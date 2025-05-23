@extends('dashboard/layouts.template')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <form action="#" method="GET" class="form-inline">
            <label class="mr-2">Filter:</label>
            <select name="filter" class="form-control mr-2" onchange="this.form.submit()">
                <option value="week" {{ ($currentFilter ?? 'month') == 'week' ? 'selected' : '' }}>Minggu</option>
                <option value="month" {{ ($currentFilter ?? 'month') == 'month' ? 'selected' : '' }}>Bulan</option>
                <option value="year" {{ ($currentFilter ?? 'month') == 'year' ? 'selected' : '' }}>Tahun</option>
            </select>
        </form>
    </div>

    <!-- Info Cards -->
    <div class="row">
        <!-- Jam & Kalender (atas bawah, di kiri) -->
        <div class="col-12 col-md-4">
            <!-- Jam -->
            <div class="card shadow mb-3">
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 45px;">
                    <h5 class="mb-0 font-weight-bold text-primary" id="realTimeClock" style="font-size: 24px;"></h5>
                </div>
            </div>

            <!-- Kalender -->
            <div class="card shadow">
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 45px;">
                    <h5 class="mb-0 font-weight-bold text-success" id="currentDate" style="font-size: 20px;"></h5>
                </div>
            </div>
        </div>
        
        <!-- Surat Masuk (tengah) -->
        <div class="col-12 col-md-4 mb-3">
            <div class="card border-left-primary shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center h-100">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-2" style="font-size: 16px;">
                                Surat Masuk
                            </div>
                            <div class="display-6 font-weight-bold text-gray-800" style="font-size: 28px;">
                                {{ $suratMasukCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengaduan Masuk (kanan) -->
        <div class="col-12 col-md-4 mb-3">
            <div class="card border-left-warning shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center h-100">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-warning text-uppercase mb-2" style="font-size: 16px;">
                                Pengaduan Masuk
                            </div>
                            <div class="display-6 font-weight-bold text-gray-800" style="font-size: 28px;">
                                {{ $pengaduanCount }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Area Chart -->
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Area Chart
        var ctx = document.getElementById("myAreaChart").getContext("2d");
        var chartData = @json($chartData);

        new Chart(ctx, {
            type: "line",
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: "Surat Masuk",
                        data: chartData.surat_masuk,
                        borderColor: "#6a9f73",
                        backgroundColor: "rgba(81, 255, 0, 0.3)",
                        fill: true
                    },
                    {
                        label: "Pengaduan Masuk",
                        data: chartData.pengaduan,
                        borderColor: "#e74a3b",
                        backgroundColor: "rgba(229, 255, 0, 0.3)",
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { grid: { display: false } },
                    y: { 
                        beginAtZero: true,
                        min: 0,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Clock and Date
        function updateClockAndDate() {
            const now = new Date();

            const hours = now.getHours().toString().padStart(2, "0");
            const minutes = now.getMinutes().toString().padStart(2, "0");
            const seconds = now.getSeconds().toString().padStart(2, "0");
            const timeString = `${hours}:${minutes}:${seconds}`;

            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const months = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            const dayName = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();
            const dateString = `${dayName}, ${date} ${month} ${year}`;

            document.getElementById("realTimeClock").textContent = timeString;
            document.getElementById("currentDate").textContent = dateString;
        }

        setInterval(updateClockAndDate, 1000);
        updateClockAndDate();
    });
</script>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('dashboard/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/sb-admin-2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

