<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MeterReading extends Model
{
    protected $fillable = [
        'meter_id',
        'reading_date',
        'previous_reading',
        'current_reading',
        'consumption',
        'is_abnormal',
        'exception_type',
        'exception_notes',
    ];

    protected $casts = [
        'reading_date' => 'date',
        'previous_reading' => 'decimal:2',
        'current_reading' => 'decimal:2',
        'consumption' => 'decimal:2',
        'is_abnormal' => 'boolean',
    ];

    /**
     * The meter this reading belongs to.
     */
    public function meter(): BelongsTo
    {
        return $this->belongsTo(Meter::class);
    }

    /**
     * The bill generated from this meter reading.
     */
    public function bill(): HasOne
    {
        return $this->hasOne(Bill::class);
    }
}