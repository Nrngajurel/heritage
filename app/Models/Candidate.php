<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'name',
        'country',
        'country_code',
        'title',
        'focus_area',
        'bio',
        'image_url',
        'votes',
        'is_featured',
        'social_media',
        'gallery',
        'quotes'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'votes' => 'integer',
        'social_media' => 'json',
        'gallery' => 'array',
    ];
    use HasFactory;
}
