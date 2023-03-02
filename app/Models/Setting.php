<?php

namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    public $incrementing = false;
    
    protected $primaryKey = 'key';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Fetch Cached settings from database
     *
     * @return string
     */
    public static function get($key, $default = null)
    {
        $cache = collect(Cache::get('settings'))->where('key', $key);
        return $cache->first()['value'] ?? $default ?? self::getDefaultValue($key);
    }

    public static function getDefaultValue($key)
    {
        $settings = collect(config('settings'))->flatten(1)->where('attributes.name', $key);
        return $settings->first()['defaultValue'] ?? null;
    }
}
