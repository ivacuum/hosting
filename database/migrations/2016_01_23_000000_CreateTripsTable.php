<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('city_id')->default(0);
            $table->string('title_ru')->default('');
            $table->string('slug')->default('');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->unsignedTinyInteger('status')->default(App\Trip::STATUS_INACTIVE);
            $table->string('meta_title_ru')->default('');
            $table->string('meta_description_ru')->default('');
            $table->string('meta_image')->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
