<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintIpController
{
    public function __invoke(Request $request)
    {
        return $request->ip() . "\n";
    }
}
