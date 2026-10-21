<?php

namespace App\Domain\Blade\Action;

use App\Action\ParseRouteDataAction;
use App\Domain\Config;
use App\Domain\I18n\Action\GetLocaleUriAction;
use App\Utilities\EnvironmentForCss;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Laravel\Head\HeadManager;

class AppendViewSharedVarsAction
{
    public function __construct(
        private ParseRouteDataAction $parseRouteData,
        private Factory $view,
        private GetLocaleUriAction $getLocaleUri,
        private HeadManager $head,
    ) {}

    public function execute(Request $request, bool $withHeadDefaults = true)
    {
        $locale = app()->getLocale();
        $routeData = $this->parseRouteData->execute();
        $browserEnv = new EnvironmentForCss($request->userAgent());
        $defaultLocale = Config::DefaultLocale->get();
        $requestUri = $this->requestUri($request, $locale, $defaultLocale);
        $routeUri = $this->routeUri($request, $locale, $defaultLocale);
        $languageLinks = $this->languageLinks($requestUri, $routeUri, $request->getQueryString());
        $offeredLocales = array_column($languageLinks, 'locale');
        $preferredLocale = $request->getLanguages() === []
            ? null
            : $request->getPreferredLanguage(['und', ...$offeredLocales]);
        $preferredLink = collect($languageLinks)->firstWhere('locale', $preferredLocale);
        $preferredLocale = $preferredLink['locale'] ?? null;

        $this->head->when($withHeadDefaults, static fn (HeadManager $head) => $head
            ->title(\ViewHelper::metaTitle($routeUri))
            ->description(\ViewHelper::metaDescription($routeUri))
            ->alternates(
                collect($languageLinks)
                    ->mapWithKeys(static fn (array $link) => [$link['locale'] => url(parse_url($link['href'], PHP_URL_PATH))])
                    ->all()
            ));

        $this->view->share([
            'tpl' => $routeData->tpl,
            'view' => $routeData->view,

            'locale' => $locale,
            'localeUri' => $this->getLocaleUri->execute(),
            'localePreferred' => $preferredLocale,
            'pageLanguageLinks' => $languageLinks,
            'preferredLanguageLink' => $preferredLink,

            'goto' => $request->input('goto'),
            'isMobile' => $browserEnv->isMobile(),
            'routeUri' => $routeUri,
            'isCrawler' => $browserEnv->isCrawler(),
            'isDesktop' => !$browserEnv->isMobile(),
            'cssClasses' => (string) $browserEnv,
            'requestUri' => $requestUri,
            'firstTimeVisit' => \Session::previousUrl() === null,
        ]);
    }

    /**
     * @return list<array{locale: string, label: string, href: string}>
     */
    private function languageLinks(string $requestUri, string $routeUri, string|null $query): array
    {
        $path = '/' . trim($requestUri, '/');
        $page = trim(rawurldecode($requestUri), '/');
        $pages = config('cfg.language_switcher.pages', []);
        $locales = $pages[$page === '' ? '/' : $page]
            ?? $pages[$routeUri]
            ?? config('cfg.language_switcher.default');
        $identities = Config::Locales->get();
        $default = Config::DefaultLocale->get();

        return collect($locales)
            ->filter(static fn (string $locale) => array_key_exists($locale, $identities))
            ->unique()
            ->map(static function (string $locale) use ($path, $query, $identities, $default): array {
                $prefix = $locale === $default ? '' : "/{$locale}";
                $href = $prefix !== '' && $path === '/' ? $prefix : $prefix . $path;

                return [
                    'locale' => $locale,
                    'label' => $identities[$locale]['label'] ?? \Locale::getDisplayName($locale, $locale),
                    'href' => $href . ($query !== null ? '?' . $query : ''),
                ];
            })
            ->values()
            ->all();
    }

    private function requestUri(Request $request, string $locale, string $defaultLocale): string
    {
        $requestUri = $request->path();

        if ($locale === $defaultLocale) {
            return $requestUri;
        }

        if ($requestUri === $locale) {
            return '';
        }

        if (str_starts_with($requestUri, "{$locale}/")) {
            return mb_substr($requestUri, mb_strlen($locale) + 1);
        }

        return $requestUri;
    }

    private function routeUri(Request $request, string $locale, string $defaultLocale): string
    {
        $routeUri = $request->route()
            ? $request->route()->uri()
            : '';

        if ($routeUri === '') {
            return '';
        }

        if ($locale === $defaultLocale) {
            return $routeUri;
        }

        if ($routeUri === $locale) {
            return '/';
        }

        if (str_starts_with($routeUri, "{$locale}/")) {
            return mb_substr($routeUri, mb_strlen($locale) + 1);
        }

        return $routeUri;
    }
}
