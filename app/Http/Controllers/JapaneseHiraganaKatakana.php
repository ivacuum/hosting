<?php namespace App\Http\Controllers;

class JapaneseHiraganaKatakana extends Controller
{
    public function index()
    {
        return view('japanese.hiragana-katakana');
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:japanese.index,japanese');
        $this->middleware('breadcrumbs:japanese.hiragana-katakana');
    }
}
