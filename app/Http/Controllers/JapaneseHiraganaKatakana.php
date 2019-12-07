<?php namespace App\Http\Controllers;

class JapaneseHiraganaKatakana extends Controller
{
    public function __construct()
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.hiragana-katakana');
    }

    public function index()
    {
        return view('japanese.hiragana-katakana');
    }
}
