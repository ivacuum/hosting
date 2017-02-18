<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ViewsFields extends Migration
{
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->unsignedInteger('views')->after('lon')->default(0);
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->unsignedInteger('views')->after('emoji')->default(0);
        });

        Schema::table('gigs', function (Blueprint $table) {
            $table->unsignedInteger('views')->after('meta_image')->default(0);
        });

        Schema::table('torrents', function (Blueprint $table) {
            $table->unsignedInteger('views')->after('clicks')->default(0);
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->unsignedInteger('views')->after('meta_image')->default(0);
        });
    }

    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('views');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('views');
        });

        Schema::table('gigs', function (Blueprint $table) {
            $table->dropColumn('views');
        });

        Schema::table('torrents', function (Blueprint $table) {
            $table->dropColumn('views');
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
}
