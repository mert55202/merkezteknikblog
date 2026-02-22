<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceClick extends Model
{
    protected $fillable = ['service_id', 'ip', 'user_agent', 'button_type', 'clicked_at'];

    protected $casts = [
        'clicked_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public static function logClick(?int $serviceId, ?string $ip, ?string $userAgent, string $buttonType = 'ara'): void
    {
        if (! $serviceId || ! $ip || filter_var($ip, FILTER_VALIDATE_IP) === false) {
            return;
        }

        if (! Service::where('id', $serviceId)->exists()) {
            return;
        }

        try {
            self::create([
                'service_id' => $serviceId,
                'ip' => $ip,
                'user_agent' => $userAgent,
                'button_type' => in_array($buttonType, ['ara', 'detay']) ? $buttonType : 'ara',
                'clicked_at' => now(),
            ]);
        } catch (\Throwable) {
            //
        }
    }
}
