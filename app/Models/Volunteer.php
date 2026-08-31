<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id', 'full_name', 'photo_path', 'dob', 'gender', 'mobile', 'email',
    'address', 'city', 'state', 'pincode', 'education', 'occupation', 'blood_group',
    'areas_of_interest', 'availability', 'experience', 'id_proof_path',
    'emergency_contact_name', 'emergency_contact_phone', 'consent', 'status',
    'volunteer_id', 'hours_logged', 'valid_from', 'valid_till', 'rejection_note',
])]
class Volunteer extends Model
{
    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'valid_from' => 'date',
            'valid_till' => 'date',
            'areas_of_interest' => 'array',
            'consent' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class)->withPivot([
            'status', 'proof_path', 'proof_note', 'completed_at', 'verified_at',
        ])->using(TaskVolunteer::class)->withTimestamps();
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function eventRegistrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public static function nextVolunteerId(): string
    {
        $year = now()->year;
        $count = static::whereNotNull('volunteer_id')
            ->where('volunteer_id', 'like', "HHNF-$year-%")
            ->count() + 1;

        return sprintf('HHNF-%d-%05d', $year, $count);
    }
}
