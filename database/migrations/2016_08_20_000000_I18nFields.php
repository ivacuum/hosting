<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class I18nFields extends Migration
{
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->string('title_en')->after('title_ru');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->string('title_en')->after('title_ru');
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->string('title_en')->after('title_ru');
            $table->string('meta_title_en')->after('meta_title_ru');
            $table->string('meta_description_en')->after('meta_description_ru');
        });
    }

    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('title_en');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('title_en');
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'meta_title_en', 'meta_description_en']);
        });
    }
}
