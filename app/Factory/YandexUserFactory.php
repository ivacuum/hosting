<?php namespace App\Factory;

use App\YandexUser;
use Illuminate\Foundation\Testing\WithFaker;

class YandexUserFactory
{
    use WithFaker;

    private $token;
    private $account;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new YandexUser;
        $model->token = $this->token ?? $this->faker->lexify('????????????????');
        $model->account = $this->account ?? $this->faker->lexify('????????????????');

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }
}
