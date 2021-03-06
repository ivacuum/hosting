<?php namespace App\Http\Controllers;

use Symfony\Component\Finder\Finder;

class KoreanPsy extends Controller
{
    public function __invoke()
    {
        $songs = [];

        foreach ($this->songsIterator() as $template) {
            $tpl = $template->getBasename('.blade.php');

            $songs[] = [
                'link' => path(KoreanPsySong::class, $tpl),
                'title' => \Str::of($tpl)->replace('-', ' ')->title(),
            ];
        }

        return view('korean.psy', ['songs' => $songs]);
    }

    /**
     * @return \Symfony\Component\Finder\Finder|\Symfony\Component\Finder\SplFileInfo[]
     */
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
