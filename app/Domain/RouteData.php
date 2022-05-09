<?php namespace App\Domain;

class RouteData
{
    public function __construct(
        public readonly string $tpl,
        public readonly string $view,
        public readonly string $controller
    ) {
    }
}
