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

    public function down()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->dropColumn([
                'text',
                'cms_type',
                'cms_version',
                'cms_url',
                'cms_user',
                'cms_pass',
                'ftp_host',
                'ftp_user',
                'ftp_pass',
                'ssh_host',
                'ssh_user',
                'ssh_pass',
                'db_pma',
                'db_host',
                'db_user',
                'db_pass'
            ]);
        });
    }
}
