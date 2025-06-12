<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyYearColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'year')) {
                $table->dropColumn('year');
            }

          
            $table->smallInteger('year')
                  ->nullable()
                  ->after('model'); // put it after whichever column makes sense
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'year')) {
                $table->dropColumn('year');
            }

            $table->year('year')
                  ->nullable()
                  ->after('model');
        });
    }
}
