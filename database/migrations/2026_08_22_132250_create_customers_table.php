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
        Schema::create('customers', function (Blueprint $table) {

            $table->id();

            // Customer identification
            $table->string('customer_number')->unique();
            $table->string('full_name');
            $table->string('id_number')->nullable();

            // Contact information
            $table->string('phone_number');
            $table->string('email')->nullable();

            // Location
            $table->string('area')->nullable();
            $table->text('address')->nullable();

            // Account status
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
        Schema::dropIfExists('customers');
    }
};