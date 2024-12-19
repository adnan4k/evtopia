<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customer_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->year('year')->nullable();
            $table->date('service_date')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('customer_vehicles');
    }
    
};
