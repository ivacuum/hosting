<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DomainCredentials extends Migration
{
    public function up()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->mediumText('text');
            $table->string('cms_type');
            $table->string('cms_version');
            $table->string('cms_url');
            $table->string('cms_user');
            $table->string('cms_pass');
            $table->string('ftp_host');
            $table->string('ftp_user');
            $table->string('ftp_pass');
            $table->string('ssh_host');
            $table->string('ssh_user');
            $table->string('ssh_pass');
            $table->string('db_pma');
            $table->string('db_host');
            $table->string('db_user');
            $table->string('db_pass');
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
