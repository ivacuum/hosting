<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DomainAlias extends Migration
{
    public function up()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->integer('alias_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->dropColumn('alias_id');
        });
    }
}
