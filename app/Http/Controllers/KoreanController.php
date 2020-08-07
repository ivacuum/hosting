<?php namespace App\Http\Controllers;

class KoreanController extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:Корейский язык');
    }

    public function __invoke()
    {
        return view('korean.index');
    }
}
