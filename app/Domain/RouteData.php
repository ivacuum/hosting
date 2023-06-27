<?php

namespace App\Domain;

readonly class RouteData
{
    public function __construct(
        public string $tpl,
        public string $view,
        public string $controller
    ) {
    }
}
