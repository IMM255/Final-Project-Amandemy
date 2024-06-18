<?php

namespace App\Exports;

use App\Models\Complaint;
use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PengaduanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Complaint::all();

        // Mengubah format data sesuai kebutuhan
        $formattedData = $data->map(function ($item) {
            return [
                'created_at' => $item->created_at,
                'name' => $item->user->name,
                'description' => $item->description,
                'location' => $item->location,
                'category' => $item->category->name_category,
                'status' => $item->status,
            ];
        });

        return $formattedData;
    }

    public function headings(): array
    {
        return ["Tanggal","Nama Pengadu", "Isi Laporan", "Lokasi", "Kategori", "Status Pengaduan"];
    }

}
