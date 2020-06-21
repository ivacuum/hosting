<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('host');
            $table->mediumText('text');
            $table->string('ftp_host');
            $table->string('ftp_root');
            $table->string('ftp_user');
            $table->string('ftp_pass');
            $table->timestamps();
        });
    }
}
