<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordRemindersTable extends Migration
{
    public function up()
    {
        Schema::create('password_reminders', function (Blueprint $table)
        {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('password_reminders');
    }
}
