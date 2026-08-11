<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'tag', 'image', 'image_id', 'nearby', 'sort_order', 'active',
    ];

    protected $casts = [
        'nearby'     => 'array',
        'sort_order' => 'integer',
        'active'     => 'boolean',
    ];

    /**
     * Seeded rows store a path relative to public/, while uploads store an
     * absolute Cloudinary or /storage URL. Normalise both to something usable
     * straight in a src or background-image.
     */
    public function getImageUrlAttribute(): string
    {
        $image = $this->image;

        if (!$image) {
            return asset('assets/images/backgrounds/bg_7.jpg');
        }

        if (preg_match('#^(https?:)?//#', $image) || strpos($image, '/') === 0) {
            return $image;
        }

        return asset($image);
    }
}
