<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'blog_posts';

    public $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'image',
        'image_id',
        'published',
        'published_at',
    ];

    protected $casts = [
        'published'    => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title) . '-' . uniqid();
            }
            if ($post->published && empty($post->published_at)) {
                $post->published_at = now();
            }
        });
        static::updating(function ($post) {
            if ($post->published && empty($post->published_at)) {
                $post->published_at = now();
            }
        });
    }

    public function getCategoryColorAttribute(): string
    {
        return match ($this->category) {
            'event'    => '#7c3aed',
            'tour'     => '#C85A2A',
            'upcoming' => '#16a34a',
            default    => '#0369a1',
        };
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'event'    => 'Event',
            'tour'     => 'Tour',
            'upcoming' => 'Upcoming',
            default    => 'News',
        };
    }
}
