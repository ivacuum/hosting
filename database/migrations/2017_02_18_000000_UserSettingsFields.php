<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserSettingsFields extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('theme')->after('status')->default(0);
            $table->unsignedTinyInteger('torrent_short_title')->after('theme')->default(0);
        });
    }
}
