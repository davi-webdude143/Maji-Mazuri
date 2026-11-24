<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bill extends Model
{
    protected $fillable = [
        'invoice_number',
        'mpesa_checkout_request_id',
        'customer_id',
        'meter_reading_id',
        'billing_date',
        'consumption',
        'rate_per_unit',
        'water_charge',
        'previous_balance',
        'status',
        'amount_paid',
        'balance',
    ];

    protected $casts = [
        'billing_date' => 'date',
        'consumption' => 'decimal:2',
        'rate_per_unit' => 'decimal:2',
        'water_charge' => 'decimal:2',
        'previous_balance' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'balance' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (Bill $bill) {
            $year = now()->year;

            $lastBill = static::whereYear('created_at', $year)
                ->latest('id')
                ->first();

            $nextNumber = $lastBill
                ? ((int) substr($lastBill->invoice_number, -6)) + 1
                : 1;

            $bill->invoice_number =
                'INV-' . $year . '-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function meterReading(): BelongsTo
    {
        return $this->belongsTo(MeterReading::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}