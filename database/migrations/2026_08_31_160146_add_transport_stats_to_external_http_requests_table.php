<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('external_http_requests', function (Blueprint $table) {
            $table->unsignedSmallInteger('http_code')->nullable()->change();
            $table->unsignedBigInteger('queue_time_us')->default(0)->after('response_size');
            $table->unsignedBigInteger('namelookup_time_us')->default(0)->after('queue_time_us');
            $table->unsignedBigInteger('connect_time_us')->default(0)->after('namelookup_time_us');
            $table->unsignedBigInteger('appconnect_time_us')->default(0)->after('connect_time_us');
            $table->unsignedBigInteger('pretransfer_time_us')->default(0)->after('appconnect_time_us');
            $table->unsignedBigInteger('posttransfer_time_us')->default(0)->after('pretransfer_time_us');
            $table->unsignedBigInteger('starttransfer_time_us')->default(0)->after('posttransfer_time_us');
            $table->string('primary_ip')->nullable()->after('redirect_url');
            $table->unsignedSmallInteger('primary_port')->nullable()->after('primary_ip');
            $table->string('local_ip')->nullable()->after('primary_port');
            $table->unsignedSmallInteger('local_port')->nullable()->after('local_ip');
            $table->integer('ssl_verify_result')->nullable()->after('local_port');
            $table->boolean('used_proxy')->nullable()->after('ssl_verify_result');
            $table->unsignedSmallInteger('curl_errno')->nullable()->after('used_proxy');
            $table->integer('os_errno')->nullable()->after('curl_errno');
            $table->string('failure_category')->nullable()->after('os_errno');
            $table->text('curl_error')->nullable()->after('failure_category');
        });
    }
};
