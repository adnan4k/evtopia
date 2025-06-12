<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyYearColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the old YEAR column if it exists
        if (Schema::hasColumn('users', 'year')) {
            DB::statement('ALTER TABLE `users` DROP COLUMN `year`');
        }

        // Add the new SMALLINT column for 'year'
        DB::statement('ALTER TABLE `users` ADD COLUMN `year` SMALLINT NULL AFTER `model`');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the SMALLINT 'year' column if it exists
        if (Schema::hasColumn('users', 'year')) {
            DB::statement('ALTER TABLE `users` DROP COLUMN `year`');
        }

        // Restore the original YEAR type column
        DB::statement('ALTER TABLE `users` ADD COLUMN `year` YEAR NULL AFTER `model`');
    }
}
