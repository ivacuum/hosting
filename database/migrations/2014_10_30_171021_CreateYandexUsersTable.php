<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYandexUsersTable extends Migration
{
    public function up()
    {
        Schema::create('yandex_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account');
            $table->string('token');
            $table->timestamps();
        });

        Schema::table('domains', function (Blueprint $table) {
            $table->integer('yandex_user_id')->unsigned()->default(0)->index();
        });
    }
}
