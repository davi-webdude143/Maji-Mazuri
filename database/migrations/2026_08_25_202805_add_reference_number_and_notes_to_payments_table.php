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
        Schema::table('payments', function (Blueprint $table) {

            if (!Schema::hasColumn('payments', 'reference_number')) {
                $table->string('reference_number', 100)
                    ->nullable()
                    ->after('payment_method');
            }

            if (!Schema::hasColumn('payments', 'notes')) {
                $table->text('notes')
                    ->nullable()
                    ->after('reference_number');
            }

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            if (Schema::hasColumn('payments', 'reference_number')) {
                $table->dropColumn('reference_number');
            }

            if (Schema::hasColumn('payments', 'notes')) {
                $table->dropColumn('notes');
            }

        });
    }
};