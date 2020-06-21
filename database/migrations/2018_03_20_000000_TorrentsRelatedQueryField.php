<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TorrentsRelatedQueryField extends Migration
{
    public function up()
    {
        Schema::table('torrents', function (Blueprint $table) {
            $table->string('related_query')->after('html');
        });
    }
}
