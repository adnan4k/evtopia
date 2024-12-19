<?php

use App\Models\Media;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Media::class)->nullable()->constrained()->nullOnDelete();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_categories');
    }
}
