<?php

use Illuminate\Database\Seeder;

class DcppHubsSeeder extends Seeder
{
    public function run()
    {
        factory(App\DcppHub::class, 3)->create();
    }
}
