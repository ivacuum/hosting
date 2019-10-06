<?php namespace App\Http\Controllers;

class WellKnownChangePasswordController extends Controller
{
    public function __invoke()
    {
        event(new \App\Events\Stats\WellKnownChangePassword);

        return redirect(path('MyPassword@edit'), 301);
    }
}
