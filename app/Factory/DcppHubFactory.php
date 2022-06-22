<?php namespace App\Factory;

use App\DcppHub;
use App\Domain\DcppHubStatus;

class DcppHubFactory
{
    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new DcppHub;
        $model->port = 411;
        $model->title = fake()->words(3, true);
        $model->clicks = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->status = DcppHubStatus::Published;
        $model->address = fake()->domainName();

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }
}
