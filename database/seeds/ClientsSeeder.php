<?php

use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    const COUNT = 3;

    public function run()
    {
        factory(App\Client::class, self::COUNT)->create();
    }
}
