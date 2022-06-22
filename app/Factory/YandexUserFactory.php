<?php namespace App\Factory;

use App\YandexUser;

class YandexUserFactory
{
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
        $model->token = $this->token ?? fake()->lexify('????????????????');
        $model->account = $this->account ?? fake()->lexify('????????????????');

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }
}
