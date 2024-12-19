<?php

use App\Models\Address;
use App\Models\Customer;
use App\Models\Gift;
use App\Models\Service;
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
        Schema::create('service_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Service::class)->constrained()->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->boolean('is_buy_now')->default(0);
            $table->foreignIdFor(Gift::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Address::class)->nullable()->constrained()->nullOnDelete();
            $table->string('gift_sender_name')->nullable();
            $table->string('gift_receiver_name')->nullable();
            $table->string('gift_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_carts');
    }
};
