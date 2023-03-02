<?php

namespace App\Models;

use App\Models\CommodityPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commodity extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'unit',
    ];

    public function lastPrice()
    {
        return $this->hasOne(CommodityPrice::class)->orderBy('id', 'desc');
    }

    public function prices()
    {
        return $this->hasMany(CommodityPrice::class);
    }
}
