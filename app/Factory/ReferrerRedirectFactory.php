<?php namespace App\Factory;

use App\ReferrerRedirect;
use Carbon\CarbonInterface;

class ReferrerRedirectFactory
{
    private $startsAt;
    private $expiresAt;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function expired()
    {
        return $this->withStartsAt(now()->subDays(2))
            ->withExpiresAt(now()->subDay());
    }

    public function make()
    {
        $model = new ReferrerRedirect;
        $model->to = fake()->url();
        $model->from = '/life';
        $model->clicks = 0;
        $model->starts_at = $this->startsAt ?? now()->toDateTimeString();
        $model->expires_at = $this->expiresAt ?? now()->addDays()->toDateTimeString();

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withExpiresAt(CarbonInterface $expiresAt)
    {
        $factory = clone $this;
        $factory->expiresAt = $expiresAt;

        return $factory;
    }

    public function withStartsAt(CarbonInterface $startsAt)
    {
        $factory = clone $this;
        $factory->startsAt = $startsAt->toDateTimeString();

        return $factory;
    }
}
