<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gallery) {
            if (!$gallery->sort_order) {
                $gallery->sort_order = Gallery::max('sort_order') + 1;
            }
        });
    }
}
