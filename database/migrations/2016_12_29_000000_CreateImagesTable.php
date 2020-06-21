<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->string('slug');
            $table->char('date', 6);
            $table->unsignedBigInteger('size')->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });
    }
}
