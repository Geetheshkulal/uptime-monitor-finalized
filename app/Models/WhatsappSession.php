<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'error_message',
        'qr_code',
        'user_name',
        'profile_photo_path',
    ];
}
