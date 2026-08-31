<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'subject', 'message', 'read_at'])]
class ContactMessage extends Model
{
    protected function casts(): array
    {
        return ['read_at' => 'datetime'];
    }

    public function scopeUnread(Builder $query): void
    {
        $query->whereNull('read_at');
    }
}
