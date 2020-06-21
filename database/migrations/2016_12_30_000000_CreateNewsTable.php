<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->string('title');
            $table->text('html');
            $table->string('locale', 10);
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });
    }
}
