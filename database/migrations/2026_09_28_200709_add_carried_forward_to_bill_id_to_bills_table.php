<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add a reference from an old bill to the newer bill
     * that carries its outstanding balance forward.
     */
    public function up(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->foreignId('carried_forward_to_bill_id')
                ->nullable()
                ->after('credit_applied')
                ->constrained('bills')
                ->nullOnDelete();
        });
    }

    /**
     * Remove the carried-forward bill relationship.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign(['carried_forward_to_bill_id']);
            $table->dropColumn('carried_forward_to_bill_id');
        });
    }
};

