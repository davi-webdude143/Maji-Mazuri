<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meter_readings', function (Blueprint $table) {
            $table->boolean('is_abnormal')
                ->default(false)
                ->after('consumption');

            $table->string('exception_type')
                ->nullable()
                ->after('is_abnormal');

            $table->text('exception_notes')
                ->nullable()
                ->after('exception_type');
        });
    }

    public function down(): void
    {
        Schema::table('meter_readings', function (Blueprint $table) {
            $table->dropColumn([
                'is_abnormal',
                'exception_type',
                'exception_notes',
            ]);
        });
    }
};