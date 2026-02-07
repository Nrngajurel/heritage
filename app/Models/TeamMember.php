<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class TeamMember extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $fillable = [
        'name',
        'position',
        'image',
        'description',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'whatsapp_url',
        'is_featured',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    /**
     * Scope to get only featured members
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Scope to get only regular (non-featured) members
     */
    public function scopeRegular($query)
    {
        return $query->where('is_featured', false)
            ->where('is_active', true)
            ->orderBy('order');
    }

    /**
     * Scope to get only active members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->orderBy('order');
    }
}
