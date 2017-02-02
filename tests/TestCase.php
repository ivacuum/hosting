<?php namespace Tests;

class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        // if (file_exists(dirname(__DIR__) . '/.env.test')) {
        //     Dotenv::load(dirname(__DIR__), '.env.test');
        // }

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
