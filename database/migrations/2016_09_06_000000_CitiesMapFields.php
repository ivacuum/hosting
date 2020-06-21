<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CitiesMapFields extends Migration
{
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->string('lat', 12)->after('iata')->default('');
            $table->string('lon', 12)->after('lat')->default('');
        });
    }
}
