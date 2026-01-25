<?php

namespace App\Domain\Blade\Action;

use App\Action\ParseRouteDataAction;
use App\Domain\Config;
use App\Domain\I18n\Action\GetLocaleUriAction;
use App\Utilities\EnvironmentForCss;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class AppendViewSharedVarsAction
{
    public function __construct(
        private ParseRouteDataAction $parseRouteData,
        private Factory $view,
        private GetLocaleUriAction $getLocaleUri,
    ) {}

    public function execute(Request $request)
    {
        $locale = app()->getLocale();
        $routeData = $this->parseRouteData->execute();
        $browserEnv = new EnvironmentForCss($request->userAgent());
        $defaultLocale = Config::DefaultLocale->get();
        $preferredLocale = $request->getPreferredLanguage(array_keys(Config::Locales->get()));

        $this->view->share([
            'tpl' => $routeData->tpl,
            'view' => $routeData->view,

            'locale' => $locale,
            'localeUri' => $this->getLocaleUri->execute(),
            'localePreferred' => $preferredLocale,

            'goto' => $request->input('goto'),
            'isMobile' => $browserEnv->isMobile(),
            'routeUri' => $this->routeUri($request, $locale, $defaultLocale),
            'isCrawler' => $browserEnv->isCrawler(),
            'isDesktop' => !$browserEnv->isMobile(),
            'cssClasses' => (string) $browserEnv,
            'requestUri' => $this->requestUri($request, $locale, $defaultLocale),
            'firstTimeVisit' => \Session::previousUrl() === null,
        ]);
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
