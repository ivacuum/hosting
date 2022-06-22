<?php namespace App\Factory;

use App\Domain;
use App\Domain\DomainMonitoring;

class DomainFactory
{
    private $domain;
    private $clientId;
    private DomainMonitoring $status = DomainMonitoring::Yes;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Domain;

        $model->domain = $this->domain ?? fake()->domainName();
        $model->status = $this->status;
        $model->client_id = $this->clientId;
        $model->paid_till = fake()->dateTimeBetween('-1 month', '+1 year');
        $model->registered_at = fake()->dateTimeBetween('-5 years');
        $model->domain_control = fake()->boolean(85);

        if (!$model->client_id) {
            $model->client_id = ClientFactory::new()->create()->id;
        }

        return $model;
    }

    public static function new(): self
    {
        return new self;
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

    public function withStatus(DomainMonitoring $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }
}
