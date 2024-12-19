<?php

use App\Models\Media;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Media::class)->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('discounted_price', 8, 2)->nullable();
            $table->integer('duration'); // Duration in minutes
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
