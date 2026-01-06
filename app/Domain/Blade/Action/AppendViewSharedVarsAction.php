<?php

namespace App\Domain\Blade\Action;

use App\Action\ParseRouteDataAction;
use App\Domain\Config;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Ivacuum\Generic\Utilities\EnvironmentForCss;

class AppendViewSharedVarsAction
{
    public function __construct(
        private ParseRouteDataAction $parseRouteData,
        private Factory $view,
    ) {}

    public function execute(Request $request)
    {
        $locale = $request->server->get('LARAVEL_LOCALE');
        $routeData = $this->parseRouteData->execute();
        $browserEnv = new EnvironmentForCss($request->userAgent());
        $preferredLocale = $request->getPreferredLanguage(array_keys(Config::Locales->get()));

        $this->view->share([
            'tpl' => $routeData->tpl,
            'view' => $routeData->view,

            'locale' => $locale ?: Config::Locale->get(),
            'localeUri' => $locale ? "/{$locale}" : '',
            'localePreferred' => $preferredLocale,

            'goto' => $request->input('goto'),
            'isMobile' => $browserEnv->isMobile(),
            'routeUri' => $request->route()
                ? $request->route()->uri()
                : '',
            'isCrawler' => $browserEnv->isCrawler(),
            'isDesktop' => !$browserEnv->isMobile(),
            'cssClasses' => (string) $browserEnv,
            'requestUri' => $request->path(),
            'firstTimeVisit' => \Session::previousUrl() === null,
        ]);
    }
}
