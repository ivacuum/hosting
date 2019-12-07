<?php namespace App\Http\Controllers;

class Japanese extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index');
    }

    public function index()
    {
        return view('japanese.index');
    }
}
