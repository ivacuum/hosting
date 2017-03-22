<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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

        $this->class = str_replace('App\Http\Controllers\\', '', get_class($this));
        $this->method = array_last(explode('@', \Route::currentRouteAction()));

        $this->prefix = implode('.', array_map(function ($ary) {
            return str_replace('_', '-', snake_case($ary));
        }, explode('\\', $this->class)));

        $this->view = $this->prefix.".".snake_case($this->method);
    }

    public function callAction($method, $parameters)
    {
        if (method_exists($this, 'alwaysCallBefore')) {
            call_user_func_array([$this, 'alwaysCallBefore'], $parameters);
        }

        $this->appendViewSharedVars();

        return parent::callAction($method, $parameters);
    }

    protected function appendViewSharedVars()
    {
        $locale = $this->request->segment(1);

        if (in_array($locale, array_keys(config('cfg.locales')))) {
            $request_uri = implode('/', array_slice($this->request->segments(), 1));
        } else {
            $request_uri = $this->request->path();
        }

        $locale = \App::getLocale();

        view()->share([
            'tpl' => $this->prefix,
            'goto' => $this->request->input('goto'),
            'self' => $this->class,
            'view' => $this->view,
            'locale' => $locale,
            'locale_uri' => $locale === config('app.locale') ? '' : "/{$locale}",
            'request_uri' => $request_uri,
        ]);
    }
}
