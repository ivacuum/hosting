<?php namespace App\Http\Controllers\Acp\Dev;

use App\Trip;
use Ivacuum\Generic\Controllers\Acp\BaseController;

class Templates extends BaseController
{
    public function index()
    {
        $templates = collect();
        $total = (object) ['pics' => 0];
        $langs = config('cfg.locales');

        foreach ($langs as $lang => $ary) {
            $total->{$lang} = 0;
        }

        foreach (Trip::templatesIterator() as $template) {
            $contents = $template->getContents();

            $pics = preg_match_all('/\.jpg/', $contents);
            $total->pics += $pics;

            $i18n = collect($langs)->keys()->flip()->map(function ($value, $key) use ($contents, $total) {
                return substr_count($contents, "@{$key}\n");
            })->all();

            foreach ($langs as $lang => $ary) {
                $total->{$lang} += $i18n[$lang];
            }

            $templates->push((object) [
                'name' => $template->getBasename('.blade.php'),
                'i18n' => (object) $i18n,
                'pics' => $pics,
            ]);
        }

        return view($this->view, compact('templates', 'total'));
    }

    public function template($template)
    {
        \Breadcrumbs::push($template);

        $slug = str_replace('_', '.', $template);

        $trip = Trip::inRandomOrder()->first();
        $trip->slug = $slug;

        return view($this->view, compact('template', 'trip'));
    }
}
