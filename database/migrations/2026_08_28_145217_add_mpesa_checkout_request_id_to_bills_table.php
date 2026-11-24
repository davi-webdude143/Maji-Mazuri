<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->string('mpesa_checkout_request_id')
                ->nullable()
                ->unique()
                ->after('invoice_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropUnique([
                'mpesa_checkout_request_id',
            ]);

            $table->dropColumn('mpesa_checkout_request_id');
        });
    }
};

