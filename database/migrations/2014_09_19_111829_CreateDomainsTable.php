<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('domain')->unique();
            $table->boolean('status')->unsigned()->default(0);
            $table->boolean('domain_control')->unsigned()->default(0);
            $table->timestamp('registered_at')->nullable();
            $table->timestamp('paid_till')->nullable();
            $table->string('ipv4')->default('');
            $table->string('ipv6')->default('');
            $table->string('mx')->default('');
            $table->string('ns')->default('');
            $table->timestamp('queried_at')->nullable();
            $table->timestamp('mailed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('domains');
    }
}
