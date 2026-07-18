<?php

namespace App\Domain\Dcpp\Factory;

use App\Domain\Dcpp\DcppHubStatus;
use App\Domain\Dcpp\Models\DcppHub;

class DcppHubFactory
{
    public function create(): DcppHub
    {
        $dcppHub = $this->make();
        $dcppHub->save();

        return $dcppHub;
    }

    public function make(): DcppHub
    {
        $dcppHub = new DcppHub;
        $dcppHub->port = 411;
        $dcppHub->title = fake()->words(3, true);
        $dcppHub->clicks = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $dcppHub->status = DcppHubStatus::Published;
        $dcppHub->address = fake()->domainName();

        return $dcppHub;
    }

    public static function new(): self
    {
        return new self;
    }
}
