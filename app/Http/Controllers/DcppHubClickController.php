<?php

namespace App\Http\Controllers;

use App\Domain\Dcpp\Models\DcppHub;

class DcppHubClickController
{
    public function __invoke(DcppHub $hub)
    {
        $hub->incrementClicks();

        return response()->noContent();
    }
}
