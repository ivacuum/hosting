<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKanjiRadicalTable extends Migration
{
    public function up()
    {
        Schema::create('kanji_radical', function (Blueprint $table) {
            $table->integer('radical_id')->unsigned()->index();
            $table->integer('kanji_id')->unsigned()->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kanji_radical');
    }
}
