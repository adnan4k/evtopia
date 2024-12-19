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
        if (!Schema::hasColumn('users', 'make')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('make')->nullable();
            });
        }

        if (!Schema::hasColumn('users', 'model')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('model')->nullable();
            });
        }

        if (!Schema::hasColumn('users', 'year')) {
            Schema::table('users', function (Blueprint $table) {
                $table->year('year')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['make', 'model', 'year']);
        });
    }
};
