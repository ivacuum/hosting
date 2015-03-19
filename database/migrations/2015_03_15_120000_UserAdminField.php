<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAdminField extends Migration
{
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->boolean('is_admin')->unsigned()->default(0);
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('is_admin');
		});
	}
}
