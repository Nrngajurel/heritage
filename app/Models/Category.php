<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    const TYPE_EXTERNAL = 'external';
    const TYPE_REGULAR = 'regular';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'description'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public static function getTypes(): array
    {
        return [
            self::TYPE_EXTERNAL => 'External Link',
            self::TYPE_REGULAR => 'Regular Post'
        ];
    }
}