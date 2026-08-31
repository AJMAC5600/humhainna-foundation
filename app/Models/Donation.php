<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'receipt_number', 'donor_name', 'email', 'mobile', 'pan', 'amount', 'frequency',
    'cause', 'method', 'status', 'gateway_ref', 'note', 'paid_at',
])]
class Donation extends Model
{
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public static function nextReceiptNumber(): string
    {
        return sprintf('HHNF-RCP-%d-%06d', now()->year, static::whereYear('created_at', now()->year)->count() + 1);
    }
}
