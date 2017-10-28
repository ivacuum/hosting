<?php namespace App\Http\Controllers;

use App\DcppHub;

class DcppHubClick extends Controller
{
    public function store(DcppHub $hub)
    {
        $hub->timestamps = false;
        $hub->increment('clicks');
        $hub->timestamps = true;

        event(new \App\Events\Stats\DcppHubClicked);

        return response('', 204);
    }
}
