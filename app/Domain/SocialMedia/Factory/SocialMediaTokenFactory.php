<?php

namespace App\Domain\SocialMedia\Factory;

use App\Domain\SocialMedia\Models\SocialMediaToken;
use App\Factory\UserFactory;
use App\User;
use Carbon\CarbonInterface;

class SocialMediaTokenFactory
{
    private int $userId = 1;
    private string|null $token = null;
    private CarbonInterface|null $expiresAt = null;

    private UserFactory|null $userFactory = null;

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
        $token->user_id = $this->userId ?? ($this->userFactory ?? UserFactory::new())->create()->id;
        $token->expired_at = $this->expiresAt ?? now()->addMonth();

        return $token;
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

    public function withToken(string $token)
    {
        $factory = clone $this;
        $factory->token = $token;

        return $factory;
    }

    public function withUser(int|User|UserFactory|null $user = null)
    {
        $factory = clone $this;

        if ($user instanceof User) {
            $factory->userId = $user->id;
        } elseif (is_int($user)) {
            $factory->userId = $user;
        } else {
            $factory->userFactory = $user ?? UserFactory::new();
        }

        return $factory;
    }
}
