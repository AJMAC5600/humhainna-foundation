<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'title', 'slug', 'banner_path', 'category', 'starts_at', 'ends_at', 'location',
    'map_link', 'description', 'volunteers_required', 'volunteer_roles',
    'registration_open', 'status',
])]
class Event extends Model
{
    protected $table = 'events';

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')->orderBy('starts_at');
    }

    public function scopePast($query)
    {
        return $query->where('status', 'completed')->orderByDesc('starts_at');
    }

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'registration_open' => 'boolean',
        ];
    }
}
