<?php

namespace App\Http\Middleware;

use App\Action\ParseRouteDataAction;
use Illuminate\Http\Request;
use Ivacuum\Generic\Utilities\EnvironmentForCss;

class AppendViewSharedVars
{
    public function __construct(private ParseRouteDataAction $parseRouteData)
    {
    }

    public function handle(Request $request, \Closure $next)
    {
        if (!$request->isMethod('GET') && !$request->isMethod('HEAD')) {
            return $next($request);
        }

        $locale = $request->server->get('LARAVEL_LOCALE');
        $routeData = $this->parseRouteData->execute();
        $browserEnv = new EnvironmentForCss($request->userAgent());
        $preferredLocale = $request->getPreferredLanguage(array_keys(config('cfg.locales')));

        view()->share([
            'tpl' => $routeData->tpl,
            'view' => $routeData->view,

            'locale' => $locale ?: config('app.locale'),
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

        return $next($request);
    }
}
