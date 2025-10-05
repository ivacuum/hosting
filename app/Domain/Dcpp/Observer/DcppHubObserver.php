<?php

namespace App\Domain\Dcpp\Observer;

use App\Domain\Dcpp\Models\DcppHub;
use Illuminate\Support\Str;

class DcppHubObserver
{
    public function saving(DcppHub $hub)
    {
        $this->maintainConsistency($hub);
    }

    private function maintainConsistency(DcppHub $hub): void
    {
        $hub->title = Str::trim($hub->title);
        $hub->address = Str::trim($hub->address);
    }
}
