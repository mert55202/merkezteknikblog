<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteContent extends Model
{
    protected $fillable = ['page', 'key', 'label', 'type', 'value', 'order'];

    public static function getValue(string $key, ?string $default = null): ?string
    {
        $content = Cache::rememberForever('site_content_' . $key, function () use ($key) {
            return static::where('key', $key)->first();
        });

        return $content?->value ?? $default;
    }

    public static function forgetCache(string $key): void
    {
        Cache::forget('site_content_' . $key);
    }

    public static function forgetAllCache(): void
    {
        foreach (static::pluck('key') as $key) {
            static::forgetCache($key);
        }
    }
}
