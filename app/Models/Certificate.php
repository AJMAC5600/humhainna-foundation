<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'certificate_number', 'type', 'volunteer_id', 'recipient_name', 'recipient_email',
    'reason', 'duration', 'issued_on', 'signatory_name', 'signatory_designation',
])]
class Certificate extends Model
{
    protected function casts(): array
    {
        return ['issued_on' => 'date'];
    }

    public function volunteer(): BelongsTo
    {
        return $this->belongsTo(Volunteer::class);
    }

    public const TYPES = [
        'participation' => 'Certificate of Participation',
        'appreciation' => 'Certificate of Appreciation',
        'collaboration' => 'Certificate of Collaboration',
        'achievement' => 'Certificate of Achievement',
        'internship' => 'Internship Completion Certificate',
    ];

    public static function nextNumber(): string
    {
        $year = now()->year;
        $count = static::whereYear('created_at', now()->year)->count() + 1;

        return sprintf('HHNF-CERT-%d-%05d', $year, $count);
    }
}
