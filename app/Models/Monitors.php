<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Monitors extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'allowed_status_codes' => 'array',
    ];

    public function pingResponses()
    {
        return $this->hasMany(PingResponse::class, 'monitor_id');
    }

    public function latestPortResponse()
    {
    
        return $this->hasOne(PortResponse::class,'monitor_id')->latest();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'monitor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class, 'monitor_id');
    }

    public function latestIncident()
    {
        return $this->incidents()->orderByDesc('start_timestamp')->first();
    }
    
    public function getExpandedStatusCodesAttribute()
    {
        $expanded = [];

        foreach ($this->allowed_status_codes ?? [] as $code) {
            if (preg_match('/^([1-5])xx$/', $code, $matches)) {
                // It's a shorthand like 2xx, 3xx, etc.
                $hundreds = (int) $matches[1];
                $start = $hundreds * 100;
                $end   = $start + 99;

                for ($i = $start; $i <= $end; $i++) {
                    $expanded[] = $i;
                }
            } else {
                // Normal single code
                $expanded[] = (int) $code;
            }
        }

        return $expanded;
    }

}
