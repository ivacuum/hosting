<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Contracts\Console\Isolatable;

#[Signature('app:chore')]
#[Description('Do some chores')]
class Chore extends Command implements Isolatable
{
    public function handle()
    {
        return self::SUCCESS;
    }
}
