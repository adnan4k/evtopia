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
        DB::unprepared(<<<'SQL'
            DELIMITER $$
            DROP PROCEDURE IF EXISTS drop_column_if_exists$$
            CREATE PROCEDURE drop_column_if_exists(
                IN in_schema VARCHAR(64),
                IN in_table  VARCHAR(64),
                IN in_column VARCHAR(64)
            )
            BEGIN
                DECLARE col_count INT DEFAULT 0;
                SELECT COUNT(*) INTO col_count
                FROM information_schema.COLUMNS
                WHERE TABLE_SCHEMA = in_schema
                  AND TABLE_NAME   = in_table
                  AND COLUMN_NAME  = in_column;
                IF col_count > 0 THEN
                    SET @ddl = CONCAT(
                        'ALTER TABLE `', in_schema, '`.`', in_table,
                        '` DROP COLUMN `', in_column, '`;'
                    );
                    PREPARE stmt FROM @ddl;
                    EXECUTE stmt;
                    DEALLOCATE PREPARE stmt;
                END IF;
            END$$
            DELIMITER ;

            CALL drop_column_if_exists(DATABASE(), 'users', 'year');

            ALTER TABLE `users`
              ADD COLUMN `year` SMALLINT NULL AFTER `model`;
        SQL);
    }

    public function down(): void
    {
        DB::unprepared(<<<'SQL'
            ALTER TABLE `users` DROP COLUMN `year`;

            -- (Re)create original YEAR column if you need to roll back
            ALTER TABLE `users`
              ADD COLUMN `year` YEAR NULL AFTER `model`;
        SQL);
    }
}
