<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalIdentitiesTable extends Migration
{
	public function up()
	{
		Schema::create('external_identities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->default(0);
            $table->string('provider');
            $table->string('uid');
            $table->string('email');
            $table->timestamps();
		});
	}
}
