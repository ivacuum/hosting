<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('login')->unique();
            $table->string('password');
            $table->string('salt', 5);
            $table->unsignedTinyInteger('status')->default(0);
            $table->ipAddress('ip');
            $table->string('activation_token');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('last_login_at')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
