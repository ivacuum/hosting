<?php

namespace App\Action\Acp;

use Illuminate\Support\Stringable;

class GetControllerBasenameAction
{
    public function execute(string $action): string
    {
        return str($action)
            ->before('@')
            ->whenEndsWith('Controller', fn (Stringable $string) => $string->beforeLast('Controller'))
            ->after('App\Http\Controllers\\')
            ->value();
    }
}
