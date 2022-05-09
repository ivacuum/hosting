<?php namespace App\Action\Acp;

class GetControllerClassnameAction
{
    public function execute(string $action): string
    {
        return str($action)->before('@');
    }
}
