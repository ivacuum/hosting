<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
	public function up()
	{
		Schema::create('pages', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->default(0);
			$table->integer('left_id')->unsigned();
			$table->integer('right_id')->unsigned();
			$table->integer('depth')->unsigned();
			$table->boolean('active')->unsigned()->default(0);
			$table->string('title');
			$table->string('url');
			$table->string('redirect');
			$table->string('handler');
			$table->string('method');
			$table->string('middleware');
			$table->mediumText('html');
			$table->text('meta_title');
			$table->text('meta_description');
			$table->text('meta_keywords');
			$table->boolean('noindex')->unsigned()->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pages');
	}
}
