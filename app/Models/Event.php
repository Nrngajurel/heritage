<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'form_start_date',
        'form_end_date',
        'voting_start_date',
        'voting_end_date',
        'description',
    ];

    protected $casts = [
        'form_start_date' => 'datetime',
        'form_end_date' => 'datetime',
        'voting_start_date' => 'datetime',
        'voting_end_date' => 'datetime',
    ];



    public function competitions()
    {
        return $this->belongsToMany(Competition::class);
    }

    public function applications(){

        return $this->hasMany(Application::class);
    }
}
