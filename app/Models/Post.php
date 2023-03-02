<?php

namespace App\Models;

use Carbon\Carbon;
use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Post extends Model implements Viewable
{
    use SoftDeletes;
    use HasFactory;
    use Sluggable;
    use InteractsWithViews;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'type',
        'status',
        'post_parent',
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
                'source' => 'title',
            ],
        ];
    }

    public function setContentAttribute($values)
    {
        $this->attributes['content'] = json_encode($values);
    }

    public function getContentAttribute($values)
    {
        return json_decode($values);
    }

    public function scopeDate(Builder $query, $date)
    {
        $parsedDate = Carbon::createFromFormat('m-Y', $date);
        return $query
            ->whereYear('created_at', '=', $parsedDate->year)
            ->whereMonth('created_at', '=', $parsedDate->month);
    }

    public function scopeCategory(Builder $query, $category)
    {
        return $query
            ->whereYear('created_at', '=', $parsedDate->year)
            ->whereMonth('created_at', '=', $parsedDate->month);
    }

    /**
     * Get the author of the post.
     */
    public function author() {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    /**
     * Get categories of the post.
     */
    public function categories() {
        return $this->belongsToMany('\App\Models\Category', 'posts_categories', 'post_id', 'category_id');
    }
}
