<?php

namespace App\Imports;

use App\Models\RawanPangan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class RawanPanganImport implements ToModel, WithHeadingRow, WithBatchInserts
{
    
    public function batchSize(): int
    {
        return 267;
    }

    /**
    * @param array $row
    */
    public function model($row)
    {
        if (!$row || !$row['nama_kec']) {
            return;
        }

        return new RawanPangan([
            'district' => $row['nama_kec'],
            'subdistrict' => $row['nama_desa'],
            'rasio_lahan' => $row['1_rasio_lahan'],
            'rasio_sarana' => $row['2_rasio_sarana'],
            'rasio_pddk_tidak_sejahtera' => $row['3_rasio_pddk_tidak_sejahtera'],
            'akses_jalan' => $row['4_akses_jalan'],
            'rasio_tanpa_air_bersih' => $row['5_rasio_tanpa_air_bersih'],
            'rasio_pddk_per_tenkes_per_density' => $row['6_rasio_pddk_per_tenkes_per_density'],
            'p_lahan' => $row['1_plahan'],
            'p_sarana' => $row['2_psarana'],
            'p_pddk_tidak_sejahtera' => $row['3_ptdk_sejah'],
            'p_jalan' => $row['4_pjalan'],
            'p_tanpa_air_bersih' => $row['5_pnowater'],
            'p_pddk_per_tenkes_per_density' => $row['6_ptenkes'],
            'indeks' => $row['indeks_kom'],
            'prio_komp' => $row['prio_komp'],
        ]);
    }
}
