<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class ModifyBookingsTableDropCustomerAndProviderIds extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop foreign keys if they exist, then drop the columns
            if (Schema::hasColumn('bookings', 'customer_id')) {
                // Check and drop foreign key using raw SQL to avoid errors
                DB::statement('ALTER TABLE bookings DROP FOREIGN KEY IF EXISTS bookings_customer_id_foreign');
                $table->dropColumn('customer_id');
            }
            
            if (Schema::hasColumn('bookings', 'provider_id')) {
                DB::statement('ALTER TABLE bookings DROP FOREIGN KEY IF EXISTS bookings_provider_id_foreign');
                $table->dropColumn('provider_id');
            }
            
            if (Schema::hasColumn('bookings', 'status')) {
                $table->dropColumn('status');
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Re-add the columns with constraints and default values in the rollback
            if (!Schema::hasColumn('bookings', 'customer_id')) {
                $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('bookings', 'provider_id')) {
                $table->foreignId('provider_id')->constrained('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('bookings', 'status')) {
                $table->enum('status', ['pending', 'confirmed', 'completed', 'canceled'])->default('pending');
            }
        });
    }
}
