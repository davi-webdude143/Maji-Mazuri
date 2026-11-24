<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerCredit extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'customer_id',
        'payment_id',
        'amount',
        'amount_used',
        'balance',
        'reference_number',
        'notes',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'amount_used' => 'decimal:2',
        'balance' => 'decimal:2',
    ];

    /**
     * A credit belongs to one customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * A credit may belong to one payment.
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}