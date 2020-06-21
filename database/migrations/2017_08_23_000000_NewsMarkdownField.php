<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsMarkdownField extends Migration
{
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->text('markdown')->after('title');
        });
    }
}
