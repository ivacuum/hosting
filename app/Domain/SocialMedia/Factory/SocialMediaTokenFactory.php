<?php

namespace App\Domain\SocialMedia\Factory;

use App\Domain\SocialMedia\Models\SocialMediaToken;
use App\Factory\UserFactory;
use Carbon\CarbonInterface;

class SocialMediaTokenFactory
{
    private int $userId = 1;
    private string|null $token = null;
    private CarbonInterface|null $expiresAt = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $token = new SocialMediaToken;
        $token->token = $this->token ?? fake()->uuid();
        $token->user_id = $this->userId ?? UserFactory::new()->create()->id;
        $token->expired_at = $this->expiresAt ?? now()->addMonth();

        return $token;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withToken(string $token)
    {
        $factory = clone $this;
        $factory->token = $token;

        return $factory;
    }
}
