<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Bill being paid
            $table->foreignId('bill_id')
                ->constrained('bills')
                ->cascadeOnDelete();

            // Customer making the payment
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // Payment details
            $table->decimal('amount', 12, 2);

            $table->string('payment_method')->default('mpesa');

            // M-PESA receipt / transaction reference
            $table->string('transaction_reference')
                ->nullable()
                ->unique();

            $table->dateTime('payment_date');

            // Optional notes
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};