<?php

namespace App\Http\Controllers;

use App\Page;
use App\Trip;

class Home extends Controller
{
    public function index()
    {
        $trips = Trip::where('published', 1)
            ->where('meta_image', '<>', '')
            ->orderBy('date_start', 'desc')
            ->take(3)
            ->get();

        return view('index', compact('trips'));
    }

    public function about()
    {
        return view('about');
    }

    public function cv()
    {
        return view('cv');
    }

    public function staticPage()
    {
        $breadcrumbs = Page::find($this->getPageId())->ancestorsAndSelf()->get();
        $page = $breadcrumbs[sizeof($breadcrumbs) - 1];

        return view('static', compact('breadcrumbs', 'page'));
    }
}
