<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskVolunteer extends Pivot
{
    protected $table = 'task_volunteer';

    protected $fillable = [
        'task_id', 'volunteer_id', 'status', 'proof_path', 'proof_note',
        'completed_at', 'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }
}
