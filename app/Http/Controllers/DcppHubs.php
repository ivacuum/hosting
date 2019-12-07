<?php namespace App\Http\Controllers;

use App\DcppHub;
use App\Utilities\ViewHelper;

class DcppHubs extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:dcpp.index,dc');
        $this->middleware('breadcrumbs:dcpp.hubs');
    }

    public function index(ViewHelper $viewHelper)
    {
        $hubs = DcppHub::where('status', DcppHub::STATUS_PUBLISHED)
            ->orderBy('title')
            ->get();

        return view('dcpp.hubs', [
            'hubs' => $hubs,
            'page' => 'hubs',
            'metaTitle' => $viewHelper->metaTitle('dcpp.hubs'),
        ]);
    }
}
