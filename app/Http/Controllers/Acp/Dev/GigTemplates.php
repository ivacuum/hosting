<?php namespace App\Http\Controllers\Acp\Dev;

use App\Action\FindGigTemplatesAction;
use App\Gig;

class GigTemplates
{
    public function index(FindGigTemplatesAction $findGigTemplates)
    {
        $filter = request('filter');
        $hideFinished = (int) request('hide_finished', 0);

        $templates = collect();
        $total = (object) ['pics' => 0];
        $langs = config('cfg.locales');

        foreach ($langs as $lang => $ary) {
            $total->{$lang} = 0;
        }

        foreach ($findGigTemplates->execute() as $template) {
            if (!preg_match("/{$filter}/", $template->getBasename('.blade.php'))) {
                continue;
            }

            $contents = $template->getContents();

            $i18n = collect($langs)
                ->keys()
                ->flip()
                ->map(fn ($value, $key) => substr_count($contents, "@{$key}\n"))
                ->all();

            if ($hideFinished === 1 && $i18n['ru'] === $i18n['en']) {
                continue;
            }

            if ($hideFinished === 2 && $i18n['ru'] !== $i18n['en']) {
                continue;
            }

            foreach ($langs as $lang => $ary) {
                $total->{$lang} += $i18n[$lang];
            }

            $pics = preg_match_all('/\.jpg/', $contents);
            $total->pics += $pics;

            $templates->push((object) [
                'name' => $template->getBasename('.blade.php'),
                'i18n' => (object) $i18n,
                'pics' => $pics,
            ]);
        }

        return view('acp.dev.templates.index', [
            'total' => $total,
            'templates' => $templates,
        ]);
    }

    public function show(string $template)
    {
        // Внутренние ссылки на шаблоны
        $template = str_replace('.', '_', $template);
        $slug = str_replace('_', '.', $template);
        \Breadcrumbs::push($slug);

        /** @var Gig $gig */
        $gig = Gig::inRandomOrder()->first();
        $gig->slug = $slug;

        if (request('images')) {
            $path = resource_path("views/{$gig->templatePath()}.blade.php");
            $content = \File::get($path);

            $lines = explode("\n", $content);
            $images = $result = [];

            foreach ($lines as $line) {
                if (preg_match('#^([A-Za-z_\d]+\.[a-z]{3,4})$#', $line, $match)) {
                    $images[] = str_replace('.jpeg', '.jpg', $match[1]);
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

        return view('acp.dev.templates.show', [
            'gig' => $gig,
            'slug' => "gigs/$slug",
            'extends' => "life.gigs.{$template}",
            'timeline' => [],
            'metaTitle' => $slug,
        ]);
    }
}
