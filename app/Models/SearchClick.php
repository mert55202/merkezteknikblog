<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchClick extends Model
{
    protected $fillable = ['ip', 'user_agent', 'clicked_at'];

    protected $casts = [
        'clicked_at' => 'datetime',
    ];

    public static function logClick(?string $ip, ?string $userAgent): void
    {
        if (! $ip || filter_var($ip, FILTER_VALIDATE_IP) === false) {
            return;
        }

        try {
            self::create([
                'ip' => $ip,
                'user_agent' => $userAgent,
                'clicked_at' => now(),
            ]);
        } catch (\Throwable) {
            // Sessiz başarısızlık
        }
    }
}
