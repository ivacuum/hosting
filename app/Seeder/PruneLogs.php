<?php namespace App\Seeder;

use Illuminate\Database\Seeder;

class PruneLogs extends Seeder
{
    public function run()
    {
        file_put_contents(storage_path('logs/laravel.log'), '');
        file_put_contents(storage_path('logs/swoole_http.log'), '');
    }
}
