<?php

namespace App\Http\Controllers\Acp;

class HomeController
{
    public function __invoke()
    {
        return view('acp.index');
    }
}
