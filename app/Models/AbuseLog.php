<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AbuseLog extends Model
{
    protected $fillable = ['reason', 'ip_address', 'detail', 'user_agent'];

    /**
     * Record a blocked/abusive attempt. Never throws — logging must not break
     * the request it is observing.
     */
    public static function record(string $reason, ?string $detail = null, ?Request $request = null): void
    {
        $request ??= request();

        try {
            static::create([
                'reason' => $reason,
                'ip_address' => $request?->ip(),
                'detail' => $detail !== null ? mb_substr($detail, 0, 2048) : null,
                'user_agent' => $request ? mb_substr((string) $request->userAgent(), 0, 512) : null,
            ]);
        } catch (\Throwable $e) {
            // swallow — abuse logging is best-effort
        }
    }
}
