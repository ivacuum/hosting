<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKanjiSimilarTable extends Migration
{
    public function up()
    {
        Schema::create('kanji_similar', function (Blueprint $table) {
            $table->integer('kanji_id')->unsigned();
            $table->integer('similar_id')->unsigned();

            $table->primary(['kanji_id', 'similar_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('kanji_similar');
    }
}
