<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ru');
            $table->string('title_en');
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();
        });

        Schema::create('taggable', function (Blueprint $table) {
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('rel_id');
            $table->string('rel_type', 40);

            $table->primary(['tag_id', 'rel_id', 'rel_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('taggable');
        Schema::dropIfExists('tags');
    }
}
