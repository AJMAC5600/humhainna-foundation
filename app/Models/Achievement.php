<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'title', 'value', 'icon', 'image_path', 'link', 'date', 'description', 'sort_order'])]
class Achievement extends Model
{
    public function scopeCounters($query)
    {
        return $query->where('type', 'counter')->orderBy('sort_order');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type)->orderBy('sort_order');
    }

    protected function casts(): array { return ['date' => 'date']; }
}
