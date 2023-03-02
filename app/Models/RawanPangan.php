<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawanPangan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'district',
        'subdistrict',
        'rasio_lahan',
        'rasio_sarana',
        'rasio_pddk_tidak_sejahtera',
        'akses_jalan',
        'rasio_tanpa_air_bersih',
        'rasio_pddk_per_tenkes_per_density',
        'p_lahan',
        'p_sarana',
        'p_pddk_tidak_sejahtera',
        'p_jalan',
        'p_tanpa_air_bersih',
        'p_pddk_per_tenkes_per_density',
        'indeks',
        'prio_komp',
    ];
}
