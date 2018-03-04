<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGigsTable extends Migration
{
    public function up()
    {
        Schema::create('gigs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('city_id')->default(0);
            $table->unsignedInteger('artist_id')->default(0);
            $table->string('title_ru');
            $table->string('title_en');
            $table->string('slug');
            $table->timestamp('date')->nullable();
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->string('meta_title_ru');
            $table->string('meta_title_en');
            $table->string('meta_description_ru');
            $table->string('meta_description_en');
            $table->string('meta_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gigs');
    }
}
