<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Sluggable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'includeTrashed' => true,
                'source' => 'name',
            ]
        ];
    }

    /**
     * Get all of the related posts.
     */
    public function posts() {
        return $this->belongsToMany('\App\Models\Post', 'posts_categories', 'category_id', 'post_id');
    }
}
