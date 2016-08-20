<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
	public function up()
	{
		Schema::create('trips', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('city_id')->default(0);
			$table->string('title_ru');
			$table->string('slug');
			$table->string('tpl');
			$table->timestamp('date_start');
			$table->timestamp('date_end');
			$table->boolean('published')->unsigned()->default(0);
			$table->string('meta_title_ru');
			$table->string('meta_description_ru');
			$table->string('meta_image');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('trips');
	}
}
