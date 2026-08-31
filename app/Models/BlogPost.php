<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'excerpt', 'content', 'cover_path', 'published_at'])]
class BlogPost extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }
}
