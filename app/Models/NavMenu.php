<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavMenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'label',
        'object_type',
        'object_value',
    ];

    public function page()
    {
        return $this->hasOne('App\Models\Post', 'id', 'object_value');
    }
}
