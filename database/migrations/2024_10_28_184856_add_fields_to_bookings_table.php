<?php

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();
            $table->string('booking_code');
            $table->string('prefix')->nullable();
            $table->foreignIdFor(Coupon::class)->nullable()->constrained()->nullOnDelete();
            $table->float('coupon_discount')->nullable();
            $table->timestamp('pick_date')->nullable();
            $table->float('payable_amount');
            $table->float('total_amount');
            $table->float('discount')->nullable()->default(0);
            $table->string('payment_status');
            $table->string('order_status');
            $table->string('payment_method')->nullable();
            $table->foreignIdFor(Address::class)->nullable()->constrained()->nullOnDelete();
            $table->longText('instruction')->nullable();
            $table->string('invoice_path')->nullable();
            $table->timestamp('delivered_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn([
                'booking_code',
                'prefix',
                'coupon_discount',
                'pick_date',
                'payable_amount',
                'total_amount',
                'discount',
                'payment_status',
                'order_status',
                'payment_method',
                'instruction',
                'invoice_path',
                'delivered_at',
            ]);

            $table->dropForeign(['coupon_id']);
            $table->dropForeign(['address_id']);
        });
    }
}
