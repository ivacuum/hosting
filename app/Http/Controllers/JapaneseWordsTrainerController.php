<?php namespace App\Http\Controllers;

class JapaneseWordsTrainerController extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.words-trainer');
    }

    public function __invoke()
    {
        return view('japanese.words-trainer');
    }
}
