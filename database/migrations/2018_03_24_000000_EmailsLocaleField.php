<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailsLocaleField extends Migration
{
    public function up()
    {
        Schema::table('emails', function (Blueprint $table) {
            $table->string('locale', 10)->after('template');
        });
    }

    public function down()
    {
        Schema::table('emails', function (Blueprint $table) {
            $table->dropColumn('locale');
        });
    }
}
