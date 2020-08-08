<?php namespace App\Http\Controllers;

class KoreanHangulController extends Controller
{
    public function __invoke()
    {
        return view('korean.hangul');
    }
}
