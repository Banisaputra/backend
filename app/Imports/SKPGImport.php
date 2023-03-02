<?php

namespace App\Imports;

use App\Imports\SKPGLuasTanamImport;
use App\Imports\SKPGLuasPusoImport;
use App\Imports\SKPGLuasTanamRataRataImport;
use App\Imports\SKPGLuasPusoRataRataImport;
use App\Imports\SKPGHargaBulanBerjalanImport;
use App\Imports\SKPGStatusGiziBalitaImport;
use App\Imports\SKPGCadanganPanganPemerintahImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SKPGImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new SKPGLuasTanamImport(),
            new SKPGLuasPusoImport(),
            new SKPGLuasTanamRataRataImport(),
            new SKPGLuasPusoRataRataImport(),
            new SKPGHargaBulanBerjalanImport(),
            new SKPGStatusGiziBalitaImport(),
            new SKPGCadanganPanganPemerintahImport(),
        ];
    }
}
