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
            $table->string('title_ru')->default('');
            $table->string('title_en')->default('');
            $table->string('slug')->default('');
            $table->timestamp('date')->nullable();
            $table->tinyInteger('status')->unsigned()->default(App\Gig::STATUS_HIDDEN);
            $table->string('meta_title_ru')->default('');
            $table->string('meta_title_en')->default('');
            $table->string('meta_description_ru')->default('');
            $table->string('meta_description_en')->default('');
            $table->string('meta_image')->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gigs');
    }
}
