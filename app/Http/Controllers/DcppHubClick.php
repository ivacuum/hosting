<?php namespace App\Http\Controllers;

use App\DcppHub;

class DcppHubClick extends Controller
{
    public function store(int $id)
    {
        /* @var DcppHub $hub */
        $hub = DcppHub::find($id);

        if (!is_null($hub)) {
            $hub->incrementClicks();
        }

        return response('', 204);
    }
}
