<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'week');

        // ambil data chart sekaligus data count yang sudah difilter
        $result = $this->getChartData($filter);

        return view('dashboard.dashboardd', [ 
            'suratMasukCount' => array_sum($result['surat_masuk']),
            'pengaduanCount' => array_sum($result['pengaduan']),
            'chartData' => $result,
            'currentFilter' => $filter
        ]);
    }

    private function getChartData($filter)
    {
        $data = [
            'labels' => [],
            'surat_masuk' => [],
            'pengaduan' => []
        ];
        
        $now = Carbon::now()->setTimezone('Asia/Jakarta');
        $today = $now->format('Y-m-d');
        
        switch ($filter) {
            case 'week':
                $labels = [];
                $startDate = $now->copy()->subDays(6); // 7 hari terakhir termasuk hari ini
                
                for ($i = 0; $i < 7; $i++) {
                    $date = $startDate->copy()->addDays($i);
                    $labels[] = $this->getIndonesianDayName($date->format('l')) . ' ' . $date->format('d/m');

                    $data['surat_masuk'][] = DB::table('surat_masuk')
                        ->whereDate('tangal', $date->format('Y-m-d'))
                        ->count();

                    $data['pengaduan'][] = DB::table('pengaduan_masuk')
                        ->whereDate('tanggal', $date->format('Y-m-d'))
                        ->count();
                }
                $data['labels'] = $labels;
                break;

            case 'month':
                $labels = [];
                $currentDay = $now->day;
                $daysInMonth = $now->daysInMonth;
                
                // Pastikan menampilkan semua hari hingga hari ini
                for ($i = 1; $i <= $currentDay; $i++) {
                    $date = $now->copy()->startOfMonth()->addDays($i - 1);
                    $labels[] = $date->format('d');

                    $data['surat_masuk'][] = DB::table('surat_masuk')
                        ->whereDate('tangal', $date->format('Y-m-d'))
                        ->count();

                    $data['pengaduan'][] = DB::table('pengaduan_masuk')
                        ->whereDate('tanggal', $date->format('Y-m-d'))
                        ->count();
                }
                $data['labels'] = $labels;
                break;

            case 'year':
                $labels = [];
                $startOfYear = $now->copy()->startOfYear();
                $currentMonth = $now->month;
                
                for ($i = 1; $i <= $currentMonth; $i++) {
                    $month = $startOfYear->copy()->addMonths($i - 1);
                    $labels[] = $this->getIndonesianMonthName($month->format('M'));

                    $data['surat_masuk'][] = DB::table('surat_masuk')
                        ->whereYear('tangal', $month->year)
                        ->whereMonth('tangal', $month->month)
                        ->count();

                    $data['pengaduan'][] = DB::table('pengaduan_masuk')
                        ->whereYear('tanggal', $month->year)
                        ->whereMonth('tanggal', $month->month)
                        ->count();
                }
                $data['labels'] = $labels;
                break;
        }

        return $data;
    }

    private function getIndonesianDayName($englishDay)
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
        
        return $days[$englishDay] ?? $englishDay;
    }

    private function getIndonesianMonthName($englishMonth)
    {
        $months = [
            'Jan' => 'Januari',
            'Feb' => 'Februari',
            'Mar' => 'Maret',
            'Apr' => 'April',
            'May' => 'Mei',
            'Jun' => 'Juni',
            'Jul' => 'Juli',
            'Aug' => 'Agustus',
            'Sep' => 'September',
            'Oct' => 'Oktober',
            'Nov' => 'November',
            'Dec' => 'Desember'
        ];
        
        return $months[$englishMonth] ?? $englishMonth;
    }
}