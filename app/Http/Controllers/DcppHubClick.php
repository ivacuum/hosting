<?php namespace App\Http\Controllers;

use App\DcppHub;

class DcppHubClick extends Controller
{
    public function store(int $id)
    {
        /* @var DcppHub $hub */
        if (null !== $hub = DcppHub::find($id)) {
            $hub->incrementClicks();
        }

        return response('', 204);
    }
}
