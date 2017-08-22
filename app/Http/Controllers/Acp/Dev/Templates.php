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

    public function show($template)
    {
        \Breadcrumbs::push($template);

        $slug = str_replace('_', '.', $template);

        $trip = Trip::inRandomOrder()->first();
        $trip->slug = $slug;

        if ($this->request->input('images')) {
            $tpl = str_replace('.', '/', $trip->template());
            $path = base_path("resources/views/{$tpl}.blade.php");

            $content = \File::get($path);

            $lines = explode("\n", $content);
            $images = $result = [];

            foreach ($lines as $line) {
                if (preg_match('#^([A-Za-z_\d]+\.[a-z]{3})$#', $line, $match)) {
                    $images[] = $match[1];
                } else {
                    $sizeof = sizeof($images);

                    if ($sizeof > 1) {
                        $result[] = "@include('tpl.fotorama-2x', ['pics' => [";

                        foreach ($images as $image) {
                            $result[] = "  '{$image}',";
                        }

                        $result[] = "]])";
                    } elseif ($sizeof === 1) {
                        $result[] = "@include('tpl.pic-2x', ['pic' => '{$images[0]}'])";
                    }

                    $images = [];

                    $result[] = $line;
                }
            }

            \File::put($path, implode("\n", $result));
        }

        return view($this->view, compact('template', 'trip'));
    }
}
