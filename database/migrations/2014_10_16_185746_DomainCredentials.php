<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DomainCredentials extends Migration
{
    public function up()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->mediumText('text');
            $table->string('cms_type')->default('');
            $table->string('cms_version')->default('');
            $table->string('cms_url')->default('');
            $table->string('cms_user')->default('');
            $table->string('cms_pass')->default('');
            $table->string('ftp_host')->default('');
            $table->string('ftp_user')->default('');
            $table->string('ftp_pass')->default('');
            $table->string('ssh_host')->default('');
            $table->string('ssh_user')->default('');
            $table->string('ssh_pass')->default('');
            $table->string('db_pma')->default('');
            $table->string('db_host')->default('');
            $table->string('db_user')->default('');
            $table->string('db_pass')->default('');
        });
    }
}
