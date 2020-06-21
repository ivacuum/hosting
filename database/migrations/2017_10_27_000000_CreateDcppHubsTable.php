<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDcppHubsTable extends Migration
{
    public function up()
    {
        Schema::create('dcpp_hubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('address');
            $table->unsignedSmallInteger('port')->default(411);
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('clicks')->default(0);
            $table->timestamp('queried_at')->nullable();
            $table->timestamps();
        });
    }
}
