<?php

use App\Models\Service;
use App\Models\ServiceCategory;
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
        Schema::create('services_categories', function (Blueprint $table) {
            $table->foreignIdFor(Service::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ServiceCategory::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_categories');
    }
};
