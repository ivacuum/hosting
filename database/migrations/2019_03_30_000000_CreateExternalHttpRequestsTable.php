<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalHttpRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('external_http_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name');
            $table->string('method');
            $table->string('scheme');
            $table->string('host');
            $table->string('path');
            $table->string('query', 1000);
            $table->text('request_headers');
            $table->text('request_body');
            $table->text('response_headers');
            $table->mediumText('response_body');
            $table->unsignedBigInteger('response_size');
            $table->unsignedBigInteger('total_time_us');
            $table->unsignedSmallInteger('http_code');
            $table->string('http_version');
            $table->unsignedInteger('redirect_count');
            $table->unsignedBigInteger('redirect_time_us');
            $table->string('redirect_url');
            $table->timestamps(6);
        });
    }

    public function down()
    {
        Schema::dropIfExists('external_http_requests');
    }
}
