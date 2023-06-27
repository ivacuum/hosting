<?php

namespace App\Http\Controllers;

class WellKnownChangePasswordController
{
    public function __invoke()
    {
        event(new \App\Events\Stats\WellKnownChangePassword);

        return redirect(path([MyPasswordController::class, 'edit']), 301);
    }
}
