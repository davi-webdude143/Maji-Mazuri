<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();

            // Customer who owns the bill
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // Meter reading that generated this bill
            $table->foreignId('meter_reading_id')
                ->constrained('meter_readings')
                ->cascadeOnDelete();

            // Billing information
            $table->date('billing_date');
            $table->decimal('consumption', 10, 2);
            $table->decimal('rate_per_unit', 10, 2);
            $table->decimal('water_charge', 12, 2);

            // Bill status
            $table->enum('status', [
                'unpaid',
                'paid',
                'partially_paid',
                'overdue',
            ])->default('unpaid');

            // Payment information
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->decimal('balance', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};