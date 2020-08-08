<?php namespace App\Http\Controllers;

class JapaneseWordsTrainerController extends Controller
{
    public function __invoke()
    {
        return view('japanese.words-trainer');
    }
}
