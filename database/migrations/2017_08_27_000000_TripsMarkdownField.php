<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TripsMarkdownField extends Migration
{
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->text('markdown')->after('status');
            $table->text('html')->after('markdown');
        });
    }

    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn(['markdown', 'html']);
        });
    }
}
