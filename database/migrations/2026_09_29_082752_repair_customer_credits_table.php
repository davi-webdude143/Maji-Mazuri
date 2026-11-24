<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Repair the customer_credits table so it matches
     * the CustomerCredit model and original intended schema.
     */
    public function up(): void
    {
        Schema::table('customer_credits', function (Blueprint $table) {
            $table->foreignId('payment_id')
                ->nullable()
                ->after('customer_id')
                ->constrained('payments')
                ->nullOnDelete();

            $table->decimal('amount_used', 12, 2)
                ->default(0)
                ->after('amount');

            $table->decimal('balance', 12, 2)
                ->default(0)
                ->after('amount_used');
        });

        Schema::table('customer_credits', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }

    /**
     * Reverse the repair.
     */
    public function down(): void
    {
        Schema::table('customer_credits', function (Blueprint $table) {
            $table->dropForeign(['payment_id']);
            $table->dropColumn([
                'payment_id',
                'amount_used',
                'balance',
            ]);

            $table->string('source')
                ->default('mpesa')
                ->after('amount');
        });
    }
};

