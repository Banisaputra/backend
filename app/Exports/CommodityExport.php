<?php

namespace App\Exports;

use App\Models\Commodity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CommodityExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return ['Nama Komoditas', 'Unit', 'Harga per Unit', 'Terakhir Diperbarui'];
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Commodity::with('lastPrice')->get()->map(function ($commodity) {
            return [
                $commodity->name,
                $commodity->unit,
                $commodity->lastPrice->price,
                $commodity->lastPrice->created_at,
            ];
        });
    }
}
