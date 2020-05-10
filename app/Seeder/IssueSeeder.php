<?php namespace App\Seeder;

use App\Factory\IssueFactory;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    private const COUNT = 2;

    public function run()
    {
        for ($i = 0; $i < self::COUNT; $i++) {
            IssueFactory::new()
                ->withUser()
                ->create();

            IssueFactory::new()
                ->closed()
                ->withComment()
                ->withUser()
                ->create();
        }
    }
}
