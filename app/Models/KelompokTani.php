<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokTani extends Model
{
    use HasFactory;

    protected $table = 'kelompok_tani';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'district',
        'subdistrict',
        'group_name',
        'leader',
        'registration_number',
        'note',
    ];
}
