<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVisit extends Model
{
    protected $fillable = ['ip', 'user_agent', 'url', 'visited_at'];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    public static function logVisit(?string $ip, ?string $userAgent, ?string $url = null): void
    {
        if (! $ip || filter_var($ip, FILTER_VALIDATE_IP) === false) {
            return;
        }

        try {
            self::create([
                'ip' => $ip,
                'user_agent' => $userAgent,
                'url' => $url ? substr($url, 0, 500) : null,
                'visited_at' => now(),
            ]);
        } catch (\Throwable) {
            // Sessiz başarısızlık - raporlama kritik hata vermemeli
        }
    }
}
