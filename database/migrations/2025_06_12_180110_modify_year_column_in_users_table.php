<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyYearColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
     public function up(): void
    {
        DB::statement('ALTER TABLE `users` DROP COLUMN IF EXISTS `year`');
        DB::statement('ALTER TABLE `users` ADD COLUMN `year` SMALLINT NULL AFTER `model`');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE `users` DROP COLUMN IF EXISTS `year`');
        DB::statement('ALTER TABLE `users` ADD COLUMN `year` YEAR NULL AFTER `model`');
    }
}
