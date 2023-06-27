<?php

namespace App\Factory;

use App\Client;

class ClientFactory
{
    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Client;
        $model->name = fake()->name();
        $model->text = '';
        $model->email = fake()->safeEmail();

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }
}
