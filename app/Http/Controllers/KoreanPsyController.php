<?php namespace App\Http\Controllers;

use Symfony\Component\Finder\Finder;

class KoreanPsyController extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:korean.index,korean');
        $this->middleware('breadcrumbs:korean.psy');
    }

    public function __invoke()
    {
        $songs = [];

        foreach ($this->songsIterator() as $template) {
            $tpl = $template->getBasename('.blade.php');

            $songs[] = [
                'link' => path(KoreanPsySongController::class, $tpl),
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
            ->in(base_path('resources/views/korean/psy'))
            ->name('*.blade.php')
            ->notName('base.blade.php')
            ->sortByName();
    }
}
