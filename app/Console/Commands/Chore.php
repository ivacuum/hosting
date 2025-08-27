<?php

namespace App\Console\Commands;

use Illuminate\Contracts\Console\Isolatable;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:chore')]
class Chore extends Command implements Isolatable
{
    protected $signature = 'app:chore';
    protected $description = 'Do some chores';

    public function handle()
    {
        return self::SUCCESS;
    }
}
