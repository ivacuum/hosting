<?php

namespace App\Action;

use App\Action\Acp\DeduceTplFromControllerAction;
use App\Action\Acp\GetControllerBasenameAction;
use App\Action\Acp\GetControllerClassnameAction;
use App\Domain\RouteData;

class ParseRouteDataAction
{
    private string $tpl;
    private string $action;
    private string $controller;
    private string $controllerBasename;
    private string|null $method;

    public function __construct(
        GetControllerBasenameAction $getControllerBasename,
        GetControllerClassnameAction $getControllerClassname,
        DeduceTplFromControllerAction $deduceTplFromController
    ) {
        $this->action = \Route::currentRouteAction() ?? '';
        $this->method = $this->method();
        $this->controller = $getControllerClassname->execute($this->action);
        $this->controllerBasename = $getControllerBasename->execute($this->action);
        $this->tpl = $deduceTplFromController->execute($this->controllerBasename);
    }

    public function execute(): RouteData
    {
        return new RouteData(
            $this->tpl,
            $this->view(),
            $this->controller
        );
    }

    private function method(): string|null
    {
        if (!str_contains($this->action, '@')) {
            return null;
        }

        return str($this->action)
            ->explode('@')
            ->last();
    }

    private function view(): string
    {
        if ($this->method === null) {
            return $this->tpl;
        }

        return str($this->tpl)->append('.', str($this->method)->snake());
    }
}
