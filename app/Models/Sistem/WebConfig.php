<?php

namespace App\Models\Sistem;

use Illuminate\Database\Eloquent\Model;

class WebConfig extends Model
{
    protected $fillable = [
        'name',
        'judul',
        'logo',
        'phone',
        'address',
        'description',
        'hero_image',
        'social_media',
    ];

    protected $casts = [
        'social_media' => 'array',
    ];
}
