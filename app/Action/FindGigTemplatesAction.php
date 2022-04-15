<?php namespace App\Action;

use Symfony\Component\Finder\Finder;

class FindGigTemplatesAction
{
    public function execute()
    {
        return Finder::create()
            ->files()
            ->in(resource_path('views/life/gigs'))
            ->name('*.blade.php')
            ->notName('base.blade.php')
            ->sortByName();
    }
}
