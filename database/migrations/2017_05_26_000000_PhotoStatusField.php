<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PhotoStatusField extends Migration
{
    public function up()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->unsignedTinyInteger('status')->after('lon')->default(1);
        });
    }

    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
