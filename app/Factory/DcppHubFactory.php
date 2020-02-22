<?php namespace App\Factory;

use App\DcppHub;
use Illuminate\Foundation\Testing\WithFaker;

class DcppHubFactory
{
    use WithFaker;

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
        $model->title = $this->faker->words(3, true);
        $model->clicks = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->status = DcppHub::STATUS_PUBLISHED;
        $model->address = $this->faker->domainName;

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }
}
