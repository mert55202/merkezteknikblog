<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $fillable = [
        'order', 'title', 'slug', 'excerpt', 'content', 'image', 'phone', 'address',
        'meta_title', 'meta_description', 'meta_keywords',
        'is_published', 'published_at', 'view_count',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class, 'brand_service');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_service');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
