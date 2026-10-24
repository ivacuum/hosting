<?php

namespace App\Http\Controllers\Acp\Dev;

use App\Domain\Config;
use App\Domain\Life\Action\ConvertTemplateImagesAction;
use App\Domain\Life\Action\FindGigTemplatesAction;
use App\Domain\Life\Models\Gig;
use Illuminate\Http\Request;

class GigTemplatesController
{
    public function index(Request $request, FindGigTemplatesAction $findGigTemplates)
    {
        $filter = $request->string('filter')->toString();
        $finished = $request->query('finished');
        $translated = $request->has('translated') ? $request->boolean('translated') : null;

        $templates = collect();
        $total = (object) ['pics' => 0];
        $languages = Config::Locales->get();

        foreach ($languages as $lang => $ary) {
            $total->{$lang} = 0;
        }

        foreach ($findGigTemplates->execute() as $template) {
            if (!str_contains($template->getBasename('.blade.php'), $filter)) {
                continue;
            }

            $contents = $template->getContents();

            if ($finished !== 'any') {
                $hasUnhandledImages = preg_match('#^[A-Za-z_\d]+\.[a-z]{3,4}\r?$#m', $contents) === 1;

                if ($finished !== 'yes' && !$hasUnhandledImages) {
                    continue;
                }

                if ($finished === 'yes' && $hasUnhandledImages) {
                    continue;
                }
            }

            $i18n = collect($languages)
                ->keys()
                ->flip()
                ->map(static fn ($value, $key) => substr_count($contents, "@{$key}\n"))
                ->all();

            if ($translated === false && $i18n['ru'] === $i18n['en']) {
                continue;
            }

            if ($translated === true && $i18n['ru'] !== $i18n['en']) {
                continue;
            }

            foreach ($languages as $lang => $ary) {
                $total->{$lang} += $i18n[$lang];
            }

            $pics = preg_match_all('/\.jpe?g/', $contents);
            $total->pics += $pics;

            $templates->push((object) [
                'www' => path([GigTemplatesController::class, 'show'], $template->getBasename('.blade.php')),
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

    public function show(Request $request, ConvertTemplateImagesAction $convertTemplateImages, string $template)
    {
        // Внутренние ссылки на шаблоны
        $template = str_replace('.', '_', $template);
        $slug = str_replace('_', '.', $template);
        \Breadcrumbs::push($slug);

        $gig = Gig::query()->inRandomOrder()->first();
        $gig->slug = $slug;

        if ($request->boolean('images')) {
            $path = resource_path("views/{$gig->templatePath()}.blade.php");
            \File::put($path, $convertTemplateImages->execute(\File::get($path)));
        }

        \Head::title($slug);

        return view('acp.dev.templates.show', [
            'gig' => $gig,
            'slug' => "gigs/$slug",
            'extends' => "life.gigs.{$template}",
            'timeline' => [],
        ]);
    }
}
