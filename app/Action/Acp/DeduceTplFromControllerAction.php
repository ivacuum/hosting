<?php namespace App\Action\Acp;

class DeduceTplFromControllerAction
{
    public function execute(string $controllerBasename): string
    {
        return str($controllerBasename)
            ->explode('\\')
            ->map(fn ($part) => str($part)->snake('-'))
            ->implode('.');
    }
}
