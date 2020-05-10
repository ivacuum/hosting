<?php namespace App\Seeder;

use App\Factory\ClientFactory;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    private const COUNT = 3;

    public function run()
    {
        for ($i = 0; $i < self::COUNT; $i++) {
            ClientFactory::new()->create();
        }
    }
}
