<?php namespace App\Seeder;

use App\Factory\FileFactory;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    private const COUNT = 5;

    public function run()
    {
        for ($i = 0; $i < self::COUNT; $i++) {
            FileFactory::new()
                ->create();
        }

        FileFactory::new()
            ->hidden()
            ->create();
    }
}
