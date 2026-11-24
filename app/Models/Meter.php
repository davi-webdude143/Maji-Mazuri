<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'customer_id',
        'meter_number',
        'installation_date',
        'initial_reading',
        'current_reading',
        'maximum_reading',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'installation_date' => 'date',
        'initial_reading' => 'decimal:2',
        'current_reading' => 'decimal:2',
        'maximum_reading' => 'decimal:2',
    ];

    /**
     * A meter belongs to one customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * A meter has many readings.
     */
    public function readings(): HasMany
    {
        return $this->hasMany(MeterReading::class);
    }
}

