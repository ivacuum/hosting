<?php namespace App\Http\Controllers;

class JapaneseWordsTrainerController extends Controller
{
    public function __construct()
    {
        $this->middleware('nav:japanese.words-trainer');
    }

    public function __invoke()
    {
        return view('japanese.words-trainer');
    }
}
