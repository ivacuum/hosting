<?php

namespace App\Domain\Life\Action;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class FindGigTemplatesAction
{
    /** @return iterable<SplFileInfo> */
    public function execute(): iterable
    {
        return Finder::create()
            ->files()
            ->in(resource_path('views/life/gigs'))
            ->name('*.blade.php')
            ->notName('base.blade.php')
            ->sortByName();
    }
}
