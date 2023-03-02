<?php

namespace App\Exports;

use App\Models\KelompokTani;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KelompokTaniExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Nama Kecamatan', 'Nama Desa', 'Nama Kelompok', 'Nama Ketua Kelompok', 'Nomor Registrasi', 'Keterangan'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KelompokTani::get()->makeHidden(['created_at', 'updated_at']);
    }
}
