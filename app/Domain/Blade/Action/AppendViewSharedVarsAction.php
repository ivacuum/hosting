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
        $locale = $request->server->get('LARAVEL_LOCALE') ?: Config::Locale->get();
        $routeData = $this->parseRouteData->execute();
        $browserEnv = new EnvironmentForCss($request->userAgent());
        $preferredLocale = $request->getPreferredLanguage(array_keys(Config::Locales->get()));

        $this->view->share([
            'tpl' => $routeData->tpl,
            'view' => $routeData->view,

            'locale' => $locale,
            'localeUri' => $this->getLocaleUri->execute(),
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
