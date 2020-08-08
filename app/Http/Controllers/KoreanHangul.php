<?php namespace App\Http\Controllers;

class KoreanHangul extends Controller
{
    public function __invoke()
    {
        return view('korean.hangul');
    }
}
