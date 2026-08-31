<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['title', 'description', 'event_id', 'start_date', 'deadline', 'priority', 'hours'])]
class Task extends Model
{
    public function volunteers(): BelongsToMany
    {
        return $this->belongsToMany(Volunteer::class)
            ->withPivot(['status', 'proof_path', 'proof_note', 'completed_at', 'verified_at'])
            ->using(TaskVolunteer::class)
            ->withTimestamps();
    }
}
