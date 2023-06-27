<?php

namespace App\Action;

use Symfony\Component\Finder\Finder;

class FindTripTemplatesAction
{
    public function execute()
    {
        return Finder::create()
            ->files()
            ->in(resource_path('views/life/trips'))
            ->name('*.blade.php')
            ->notName('base.blade.php')
            ->sortByName();
    }
}
