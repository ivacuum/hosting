<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
	public function up()
	{
		Schema::create('domains', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->foreign('client_id')->references('id')->on('clients');
			$table->string('domain')->unique();
			$table->boolean('active')->unsigned()->default(0);
			$table->boolean('domain_control')->unsigned()->default(0);
			$table->timestamp('registered_at')->index();
			$table->timestamp('paid_till')->index();
			$table->string('ipv4');
			$table->string('ipv6');
			$table->string('mx');
			$table->string('ns');
			$table->timestamp('queried_at')->index();
			$table->timestamp('mailed_at');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('domains');
	}
}
