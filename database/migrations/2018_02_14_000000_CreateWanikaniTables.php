<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWanikaniTables extends Migration
{
    public function up()
    {
        Schema::create('radicals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wk_id')->default(0);
            $table->unsignedTinyInteger('level')->default(0);
            $table->string('character');
            $table->string('meaning');
            $table->string('image');
            $table->timestamps();
        });

        Schema::create('kanjis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wk_id')->default(0);
            $table->unsignedTinyInteger('level')->default(0);
            $table->string('character');
            $table->string('meaning');
            $table->string('onyomi');
            $table->string('kunyomi');
            $table->string('important_reading');
            $table->string('nanori');
            $table->timestamps();
        });

        Schema::create('vocabularies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wk_id')->default(0);
            $table->unsignedTinyInteger('level')->default(0);
            $table->string('character');
            $table->string('meaning');
            $table->string('kana');
            $table->text('sentences');
            $table->unsignedInteger('female_audio_id')->default(0);
            $table->unsignedInteger('male_audio_id')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('radicals');
        Schema::dropIfExists('kanjis');
        Schema::dropIfExists('vocabularies');
    }
}
