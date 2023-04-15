<?php namespace App\Http\Controllers;

use App\DcppHub;

class DcppHubClickController
{
    public function __invoke(DcppHub $hub)
    {
        $hub->incrementClicks();

        return response()->noContent();
    }
}
