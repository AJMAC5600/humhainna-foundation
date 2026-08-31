<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['event_id', 'volunteer_id', 'name', 'email', 'mobile', 'people_count'])]
class EventRegistration extends Model
{
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function volunteer(): BelongsTo
    {
        return $this->belongsTo(Volunteer::class);
    }
}
