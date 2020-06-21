<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersNotificationSettings extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('notify_gigs')->default(0)->after('torrent_short_title');
            $table->unsignedTinyInteger('notify_news')->default(0)->after('notify_gigs');
            $table->unsignedTinyInteger('notify_trips')->default(0)->after('notify_news');
        });
    }
}
