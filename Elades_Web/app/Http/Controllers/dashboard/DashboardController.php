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
        $filter = $request->get('filter', 'month');

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
        
        $now = Carbon::now();
        
        switch ($filter) {
            case 'day':
                $labels = [];
                for ($i = 0; $i < 24; $i++) {
                    $hour = str_pad($i, 2, '0', STR_PAD_LEFT) . ':00';
                    $labels[] = $hour;

                    $data['surat_masuk'][] = DB::table('surat_masuk')
                        ->whereDate('tangal', $now->format('Y-m-d'))
                        ->whereTime('tangal', '>=', "$i:00:00")
                        ->whereTime('tangal', '<', ($i + 1) . ':00:00')
                        ->count();

                    $data['pengaduan'][] = DB::table('pengaduan_masuk')
                        ->whereDate('tanggal', $now->format('Y-m-d'))
                        ->whereTime('tanggal', '>=', "$i:00:00")
                        ->whereTime('tanggal', '<', ($i + 1) . ':00:00')
                        ->count();
                }
                $data['labels'] = $labels;
                break;

            case 'week':
                $labels = [];
                $startOfWeek = $now->copy()->startOfWeek();
                for ($i = 0; $i < 7; $i++) {
                    $date = $startOfWeek->copy()->addDays($i);
                    $labels[] = $date->format('l');

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
                $daysInMonth = $now->daysInMonth;
                for ($i = 1; $i <= $daysInMonth; $i++) {
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

                for ($i = 0; $i < 12; $i++) {
                    $month = $startOfYear->copy()->addMonths($i);
                    $labels[] = $month->format('M');

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
}
