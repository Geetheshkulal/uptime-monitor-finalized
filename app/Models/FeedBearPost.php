<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBearPost extends Model
{
    use HasFactory;

    protected $table = 'feedbear_posts';
    protected $guarded = [];
    protected $casts = [
        'attachments' => 'array',
        'created_at' => 'datetime',
    ];
}
