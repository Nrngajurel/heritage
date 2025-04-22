<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    protected $fillable = [
        "event_id",
        'competition_id',
        'contestant_id',
        'application_id',
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

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

}
