<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrintIpForm;

class PrintIpController
{
    public function __invoke(PrintIpForm $request)
    {
        return [
            'ip' => $request->ip,
            'country' => $request->countryCode,
        ];
    }
}
