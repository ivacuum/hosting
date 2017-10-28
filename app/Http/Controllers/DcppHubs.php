<?php namespace App\Http\Controllers;

use App\DcppHub;

class DcppHubs extends Controller
{
    public function index()
    {
        $hubs = DcppHub::where('status', DcppHub::STATUS_PUBLISHED)
            ->orderBy('title')
            ->get();

        return view('dcpp.hubs', [
            'hubs' => $hubs,
            'page' => 'hubs',
            'meta_title' => \ViewHelper::metaTitle('', 'dcpp.hubs'),
        ]);
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:dcpp.index,dc');
        $this->middleware('breadcrumbs:dcpp.hubs');
    }
}
