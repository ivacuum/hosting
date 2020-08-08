<?php namespace App\Http\Controllers;

class JapaneseWordsTrainer extends Controller
{
    public function __invoke()
    {
        return view('japanese.words-trainer');
    }
}
