<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CitiesMapFields extends Migration
{
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->string('lat', 10)->after('iata')->default('');
            $table->string('lon', 10)->after('lat')->default('');
        });
    }

    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn(['lat', 'lon']);
        });
    }
}
