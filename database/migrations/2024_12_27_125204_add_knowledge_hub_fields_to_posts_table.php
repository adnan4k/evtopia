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
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('add_to_knowledge_hub')->default(false)->after('is_active'); // Checkbox field
            $table->json('pdfs')->nullable()->after('add_to_knowledge_hub'); // PDF file path
            $table->json('images')->nullable()->after('pdfs'); // JSON for image paths
            $table->json('video_links')->nullable()->after('images'); // JSON for video links or paths
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['add_to_knowledge_hub', 'pdfs', 'images', 'video_links']);
        });
    }
};
