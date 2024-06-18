<?php

namespace App\Http\Controllers;

use App\Exports\PengaduanExport;
use App\Models\Complaint;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if((Request()->from && Request()->to)){
            $from = Request()->from  . ':00:00:00';
            $to = Request()->to  . ':23:59:59';
            $pengaduans = Complaint::whereBetween('created_at',[$from, $to])
            ->orderBy('created_at', 'desc')
            ->get();
        }else{
            $pengaduans = Complaint::all()->sortDesc();
        };

        return view('pages.admin.laporan.index',compact('pengaduans'));
    }


    public function cetaklaporan()
    {
        $pengaduan = Complaint::all(); //eloquent

        $pdf = PDF::loadView('pages.admin.laporan.cetak', ['pengaduan' => $pengaduan])->setPaper('a4', 'landscape');
        return $pdf->download('laporan_pengaduan_'.date('d-m-Y').'.pdf');
    }

    public function laporanExcel()
    {
        return Excel::download(new PengaduanExport, 'laporan_pengaduan_'.date('d-m-Y').'.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
