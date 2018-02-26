<?php namespace App\Http\Controllers;

class Japanese extends Controller
{
    public function index()
    {
        return view('japanese.index');
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index');
    }
}
