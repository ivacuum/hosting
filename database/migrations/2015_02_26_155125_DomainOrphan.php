<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DomainOrphan extends Migration
{
	public function up()
	{
		Schema::table('domains', function(Blueprint $table) {
			$table->integer('orphan')->unsigned();
		});
	}

	public function down()
	{
		Schema::table('domains', function(Blueprint $table) {
			$table->dropColumn('orphan');
		});
	}
}
