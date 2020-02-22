<?php namespace App\Factory;

use App\Domain;
use Illuminate\Foundation\Testing\WithFaker;

class DomainFactory
{
    use WithFaker;

    private $domain;
    private $clientId;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Domain;

        $model->text = '';
        $model->domain = $this->domain ?? $this->faker->domainName;
        $model->status = $this->faker->boolean(85);
        $model->client_id = $this->clientId ?? 0;
        $model->paid_till = $this->faker->dateTimeBetween('-1 month', '+1 year');
        $model->registered_at = $this->faker->dateTimeBetween('-5 years');
        $model->domain_control = $this->faker->boolean(85);

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withClientId(int $clientId)
    {
        $factory = clone $this;
        $factory->clientId = $clientId;

        return $factory;
    }

    public function withDomain(string $domain)
    {
        $factory = clone $this;
        $factory->domain = $domain;

        return $factory;
    }
}
