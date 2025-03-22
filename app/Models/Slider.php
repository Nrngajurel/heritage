<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'location',
        'image_path',
        'sort_order',
        'is_active',
        'link',
        'link_text'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    const LOCATION_MAIN = 'main';
    const LOCATION_MOMENT = 'moment';
    const LOCATION_HIGHLIGHT = 'highlight';

    public static function getLocations(): array
    {
        return [
            self::LOCATION_MAIN => 'Main Slider',
            self::LOCATION_MOMENT => 'Moment Slider',
            self::LOCATION_HIGHLIGHT => 'Highlight Slider'
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($slider) {
            if (!$slider->sort_order) {
                $slider->sort_order = static::where('location', $slider->location)
                    ->max('sort_order') + 1;
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('slider_image')
            ->singleFile();
    }
}