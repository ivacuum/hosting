<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTorrentsTable extends Migration
{
    public function up()
    {
        Schema::create('torrents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('category_id')->default(0);
            $table->unsignedInteger('rto_id')->default(0);
            $table->string('title');
            $table->mediumText('html');
            $table->unsignedBigInteger('size')->default(0);
            $table->unsignedInteger('seeders')->default(0);
            $table->char('info_hash', 40);
            $table->string('announcer');
            $table->unsignedInteger('clicks')->default(0);
            $table->timestamp('registered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('torrents');
    }
}
