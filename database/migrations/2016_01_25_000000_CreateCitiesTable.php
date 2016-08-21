<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
	public function up()
	{
		Schema::create('cities', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('country_id')->default(0);
			$table->string('title_ru');
			$table->string('slug');
			$table->char('iata', 3);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}
