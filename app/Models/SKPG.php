<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKPG extends Model
{
    use HasFactory;

    protected $table = 'skpg';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'label',
        'district',
        'key',
        'value',
        'date',
    ];
}
