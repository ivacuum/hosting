<?php namespace App\Http\Controllers;

use App\DcppHub;
use App\Domain\DcppHubStatus;
use App\Utilities\ViewHelper;

class DcppHubs
{
    public function __invoke(ViewHelper $viewHelper)
    {
        $hubs = DcppHub::where('status', DcppHubStatus::Published)
            ->orderBy('title')
            ->get();

        return view('dcpp.hubs', [
            'hubs' => $hubs,
        ]);
    }
}
