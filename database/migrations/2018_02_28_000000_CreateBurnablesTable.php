<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBurnablesTable extends Migration
{
    public function up()
    {
        Schema::create('burnables', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('rel_type', 40);
            $table->unsignedInteger('rel_id');

            $table->primary(['user_id', 'rel_type', 'rel_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('burnables');
    }
}
