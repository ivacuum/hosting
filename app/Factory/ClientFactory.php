<?php namespace App\Factory;

use App\Client;
use Illuminate\Foundation\Testing\WithFaker;

class ClientFactory
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
        $model = new Client;
        $model->name = $this->faker->name;
        $model->text = '';
        $model->email = $this->faker->safeEmail;

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }
}
