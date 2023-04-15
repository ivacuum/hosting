<?php namespace App\Http\Controllers;

use Symfony\Component\Finder\Finder;

class KoreanPsyController
{
    public function __invoke()
    {
        $songs = [];

        foreach ($this->songsIterator() as $template) {
            $tpl = $template->getBasename('.blade.php');

            $songs[] = [
                'link' => path(KoreanPsySongController::class, $tpl),
                'title' => str($tpl)->replace('-', ' ')->title(),
            ];
        }

        return view('korean.psy', ['songs' => $songs]);
    }

    private function songsIterator()
    {
        return Finder::create()
            ->files()
            ->in(resource_path('views/korean/psy'))
            ->name('*.blade.php')
            ->notName('base.blade.php')
            ->sortByName();
    }
}
