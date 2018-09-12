<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetricsTable extends Migration
{
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->date('date');
            $table->string('event');
            $table->unsignedInteger('count')->default(0);

            $table->primary(['date', 'event']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('metrics');
    }
}
