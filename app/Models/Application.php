<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Application extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Notifiable;

    protected $fillable = [
        'competition_id',
        'event_id',
        'first_name',
        'last_name',
        'address',
        'country',
        'email',
        'phone',
        'avatar',
        'meta',
        'status',
    ];

    protected $casts = [
        'address' => 'array',
        'meta' => 'array',
    ];


    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function getFormattedAddressAttribute(){
        return "{$this->address['address_line_1']}, {$this->address['city']}, {$this->address['state']} {$this->address['zip']}";;
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('headshot_photo')->singleFile();
        $this->addMediaCollection('waist_up_photo')->singleFile();
        $this->addMediaCollection('passport_copy')->singleFile();
    }
}
