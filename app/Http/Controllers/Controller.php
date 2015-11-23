<?php

namespace App\Http\Controllers;

use Breadcrumbs;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Input;
use NumberFormatter;
use Route;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $class;
    protected $method;
    protected $prefix;
    protected $view;

    public function __construct()
    {
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
        $decimal = new NumberFormatter('ru_RU', NumberFormatter::DECIMAL);
        $decimal->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);

        view()->share([
            'decimal' => $decimal,
            'goto'    => Input::get('goto'),
            'self'    => $this->class,
            'tpl'     => $this->prefix,
            'view'    => $this->view,
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
