<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Media; // Make sure to import Media

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add the new column after an existing column (e.g., 'buy_price')
            $table->foreignIdFor(Media::class, 'custom_file_media_id')
                  ->nullable()
                  ->after('buy_price') // Optional: place it logically
                  ->constrained('media')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['custom_file_media_id']);
            // Then drop the column
            $table->dropColumn('custom_file_media_id');
        });
    }
};
