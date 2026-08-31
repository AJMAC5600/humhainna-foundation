<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['title', 'category', 'date', 'cover_path', 'description', 'video_url'])]
class Album extends Model
{
    protected function casts(): array { return ['date' => 'date']; }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
}
