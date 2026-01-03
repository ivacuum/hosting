<?php

namespace App\Seeder;

use App\Domain\Dcpp\Factory\DcppHubFactory;
use Illuminate\Database\Seeder;

class DcppHubSeeder extends Seeder
{
    private const int COUNT = 3;

    public function run()
    {
        for ($i = 0; $i < self::COUNT; $i++) {
            DcppHubFactory::new()->create();
        }
    }
}
