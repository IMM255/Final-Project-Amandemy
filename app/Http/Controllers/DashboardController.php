<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $statusCount = Complaint::select('status', DB::raw('COUNT(*) as total'))->groupBy('status')->pluck('total', 'status')->toArray();

        $labelsPie = array_keys($statusCount);
        $dataPie = array_values($statusCount);

        // Count jumlah dari tiap tiap databases
        $count = [
            'all' => Complaint::all()->count('id'),
            'belum_diproses' => Complaint::where('status','belum_diproses')->count(),
            'sedang_diproses' => Complaint::where('status','sedang_diproses')->count(),
            'selesai' => Complaint::where('status','selesai')->count(),
            'ditolak' => Complaint::where('status','ditolak')->count(),
            'allUser' => User::all()->count('id'),
            'admin' => User::where('role','admin')->count(),
            'masyarakat' => User::where('role','masyarakat')->count(),
        ];

        // Ambil data pengaduan dari database menggunakan Eloquent
        $pengaduan = Complaint::selectRaw('DATE(created_at) as date, COUNT(*) as total')->groupBy('date')->get();

        // Format data agar sesuai dengan format yang dibutuhkan oleh Chart.js
        $labels = $pengaduan->pluck('date')->toArray();
        $data = $pengaduan->pluck('total')->toArray();

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Pengaduan',
                    'data' => $data,
                    'backgroundColor' => '#6777ef',
                    'borderColor' => '#6777ef',
                    'borderWidth' => 3,
                    'pointBackgroundColor' => '#ffffff',
                    'pointRadius' => 4,
                    'fill' => false,
                ],
            ],
        ];
        return view('pages.admin.dashboard', compact('chartData','count','labelsPie','dataPie'));
    }
}
