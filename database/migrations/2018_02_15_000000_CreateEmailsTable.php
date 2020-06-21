<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('rel_type');
            $table->unsignedInteger('rel_id');
            $table->string('to');
            $table->string('template');
            $table->unsignedInteger('clicks')->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });
    }
}
