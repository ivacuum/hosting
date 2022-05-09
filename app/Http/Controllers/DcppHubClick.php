<?php namespace App\Http\Controllers;

use App\DcppHub;

class DcppHubClick
{
    public function __invoke(DcppHub $hub)
    {
        $hub->incrementClicks();

        return response()->noContent();
    }
}
