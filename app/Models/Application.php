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
        'event_id',
        'competition_id',
        'country',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'meta',
        'headshot_photo',
        'waist_up_photo',
        'passport_copy',
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
    public function getFullNameAttribute(){

        return $this->first_name . " " . $this->last_name;
    }

    public function contestant()
    {
        return $this->hasOne(Contestant::class);
    }

    public function registerAsContestant()
    {
        $json = file_get_contents(public_path('countries.json'));
        $country = collect(json_decode($json, true)['data'])->map(function ($item, $key) {

            return [
                'code' => $key,
                'country' => $item['country'],
                'src' => "https://flagsapi.com/{$key}/flat/64.png"
            ];
        })->where('country', $this->country)->first();

        $this->contestant()->updateOrCreate([
            'competition_id' => $this->competition_id,
            'event_id' => $this->event_id,
            'name' => $this->full_name,
            'country' => $this->country,
            'country_code' => $country['code']??'',
            'title' => $this->competition->name,
            'focus_area' => '',
            'bio' => $this->meta['personal_statement']??'',
            'social_media' => $this->meta['more']['social_links']??'',
            'votes' => 0,
            'is_featured' => false
        ]);
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('headshot_photo')->singleFile();
        $this->addMediaCollection('waist_up_photo')->singleFile();
        $this->addMediaCollection('passport_copy')->singleFile();
    }
}
