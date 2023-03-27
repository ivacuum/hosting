<?php namespace App\Seeder;

use App\Magnet;
use Illuminate\Database\Seeder;

class PruneSearchIndexes extends Seeder
{
    public function run()
    {
        Magnet::removeAllFromSearch();
    }
}
