<?php namespace App\Http\Controllers;

class JapaneseHiraganaKatakana extends Controller
{
    public function __invoke()
    {
        return view('japanese.hiragana-katakana');
    }
}
