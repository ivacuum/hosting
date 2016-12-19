<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project');
            $table->string('folder');
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('size')->default(0);
            $table->string('extension', 25);
            $table->unsignedInteger('downloads')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
