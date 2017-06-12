<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TorrentStatusField extends Migration
{
    public function up()
    {
        Schema::table('torrents', function (Blueprint $table) {
            $table->unsignedTinyInteger('status')->after('announcer')->default(1);
        });
    }

    public function down()
    {
        Schema::table('torrents', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
