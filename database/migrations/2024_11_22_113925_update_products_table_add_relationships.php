<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CarTransmission;
use App\Models\DriveTrain;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'kilometers')) {
                $table->bigInteger('kilometers')->nullable();
            }

            if (!Schema::hasColumn('products', 'year')) {
                $table->year('year')->nullable();
            }

            if (!Schema::hasColumn('products', 'drive_train_id')) {
                $table->foreignIdFor(DriveTrain::class)->nullable()->constrained()->nullOnDelete();

            }

            if (!Schema::hasColumn('products', 'car_transmission_id')) {
                $table->foreignIdFor(CarTransmission::class)->nullable()->constrained()->nullOnDelete();

            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['drive_train_id']);
            $table->dropForeign(['car_transmission_id']);
            $table->dropColumn(['drive_train_id', 'car_transmission_id', 'kilometers', 'year']);
        });
    }
};
