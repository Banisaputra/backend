<?php

namespace App\Imports;

use App\Models\SKPG;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SKPGStatusGiziBalitaImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    */
    public function model($row)
    {
        // 
        return null;

        if ((!$row[3] || !$row[4])) {
            return null;
        }

        $months = array_reverse(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
        for ($i = 12; $i >= 4; $i--) {
            if (is_numeric($row[$i])) {
                return new SKPG([
                    'title' => 'Pemantauan Status Gizi Balita',
                    'label' => 'Jumlah Balita',
                    'district' => $row[3],
                    'key' => 'Ditimbang terkoreksi (D\')',
                    'value' => $row[($i)],
                    'date' => $months[$i] . ' ' . date('Y'),
                ]);
            }
        }
    }

    /**
     * @return int
     */
    public function startRow(): int {
        return 8;
    }
}
