<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintIpController
{
    public function __invoke(Request $request)
    {
        return [
            'ip' => $request->ip(),
            'country' => $request->server->get('HTTP_CF_COUNTRY'),
        ];
    }
}
