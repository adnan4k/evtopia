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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('driving_range')->nullable()->comment('in miles');
            $table->decimal('battery_capacity', 5, 1)
                  ->nullable()
                  ->comment('in kWh');

            $table->integer('peak_power')
                  ->nullable()
                  ->comment('in kW');

            $table->decimal('acceleration_time', 3, 1)
                  ->nullable()
                  ->comment('0-60 mph in seconds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'driving_range',
                'battery_capacity',
                'peak_power',
                'acceleration_time',
            ]);
        });
    }
};
