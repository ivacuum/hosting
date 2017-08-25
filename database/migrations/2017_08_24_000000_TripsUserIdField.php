<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TripsUserIdField extends Migration
{
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->default(0)->after('id');
        });
    }

    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
