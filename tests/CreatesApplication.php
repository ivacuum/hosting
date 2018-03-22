<?php namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        // if (file_exists(dirname(__DIR__) . '/.env.test')) {
        //     Dotenv::load(dirname(__DIR__), '.env.test');
        // }

        $app->make(Kernel::class)->bootstrap();

        \Hash::driver('bcrypt')->setRounds(4);

        return $app;
    }
}
