<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'customer_number',
        'full_name',
        'id_number',
        'phone_number',
        'email',
        'area',
        'address',
        'status',
        'credit_balance',
    ];

    /**
     * Cast financial values to decimal strings with two decimal places.
     */
    protected $casts = [
        'credit_balance' => 'decimal:2',
    ];

    /**
     * A customer has one water meter.
     */
    public function meter(): HasOne
    {
        return $this->hasOne(Meter::class);
    }

    /**
     * A customer can have many bills.
     */
    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

    /**
     * A customer can have many credit records.
     */
    public function credits(): HasMany
    {
        return $this->hasMany(CustomerCredit::class);
    }
}