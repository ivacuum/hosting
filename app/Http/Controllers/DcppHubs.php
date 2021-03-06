<?php namespace App\Http\Controllers;

use App\DcppHub;
use App\Utilities\ViewHelper;

class DcppHubs extends Controller
{
    public function __invoke(ViewHelper $viewHelper)
    {
        $hubs = DcppHub::where('status', DcppHub::STATUS_PUBLISHED)
            ->orderBy('title')
            ->get();

        return view('dcpp.hubs', [
            'hubs' => $hubs,
        ]);
    }
}
