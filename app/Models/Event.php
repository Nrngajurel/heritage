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


    public function competitions()
    {
        return $this->belongsToMany(Competition::class);
    }
}
