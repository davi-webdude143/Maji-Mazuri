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
        Schema::create('meters', function (Blueprint $table) {
            $table->id();

            // Customer who owns this meter
            $table->foreignId('customer_id')
                ->constrained('customers')
                ->cascadeOnDelete();

            // Unique water meter number
            $table->string('meter_number')->unique();

            // Meter installation details
            $table->date('installation_date')->nullable();

            // Initial meter reading
            $table->decimal('initial_reading', 10, 2)->default(0);

            // Current meter reading
            $table->decimal('current_reading', 10, 2)->default(0);

            // Meter status
            $table->enum('status', ['active', 'inactive'])
                ->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meters');
    }
};