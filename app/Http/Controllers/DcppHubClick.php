<?php namespace App\Http\Controllers;

use App\DcppHub;

class DcppHubClick extends Controller
{
    public function store(DcppHub $hub)
    {
        $hub->incrementClicks();

        return response()->noContent();
    }
}
