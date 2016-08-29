<?php namespace App\Http\Controllers;

use App;
use Breadcrumbs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use NumberFormatter;
use Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;

    protected $class;
    protected $method;
    protected $prefix;
    protected $view;

    public function __construct()
    {
        $this->request = request();

        $this->class  = str_replace('App\Http\Controllers\\', '', get_class($this));
        $this->method = $this->getCurrentMethod();
        $this->prefix = $this->getViewPrefix();
        $this->view   = $this->prefix.".".snake_case($this->method);

        $this->appendViewSharedVars();
    }

    public function callAction($method, $parameters)
    {
        Breadcrumbs::parseRoutes();

        return call_user_func_array([$this, $method], $parameters);
    }

    protected function appendViewSharedVars()
    {
        $locale = $this->request->segment(1);

        if (in_array($locale, array_keys(config('cfg.locales')))) {
            $request_uri = str_replace(["{$locale}/", $locale], '', $this->request->path());
        } else {
            $request_uri = $this->request->path();
        }

        $decimal = new NumberFormatter('ru_RU', NumberFormatter::DECIMAL);
        $decimal->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

        $locale = App::getLocale();

        view()->share([
            'decimal'     => $decimal,
            'goto'        => $this->request->input('goto'),
            'locale'      => $locale,
            'locale_uri'  => $locale === config('cfg.default_locale') ? '' : "/{$locale}",
            'request_uri' => $request_uri,
            'self'        => $this->class,
            'tpl'         => $this->prefix,
            'view'        => $this->view,
        ]);
    }

    protected function getCurrentMethod()
    {
        $method = Route::currentRouteAction();

        return substr($method, strpos($method, '@') + 1);
    }

    protected function getViewPrefix()
    {
        return strtolower(str_replace(
            ['App\Http\Controllers\\', '\\'],
            ['', '.'],
            $this->class
        ));
    }
}
