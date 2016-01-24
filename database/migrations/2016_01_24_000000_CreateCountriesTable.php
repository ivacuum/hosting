<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
	public function up()
	{
		Schema::create('countries', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('slug');
			$table->string('emoji', 20)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->collate('utf8mb4_unicode_ci');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('countries');
	}
}
