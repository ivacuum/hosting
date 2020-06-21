<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('rel_id');
            $table->string('rel_type', 50);
            $table->string('type', 50);
            $table->string('title');
            $table->ipAddress('ip')->index();
            $table->string('user_agent');
            $table->timestamps();
        });
    }
}
