<?php

namespace App\Domain\SocialMedia\Factory;

use App\Domain\SocialMedia\Models\SocialMediaToken;
use App\Factory\UserFactory;
use App\User;
use Carbon\CarbonInterface;

class SocialMediaTokenFactory
{
    private string|null $token = null;
    private CarbonInterface|null $expiresAt = null;

    private int|User|UserFactory|null $user = 1;

    public function create(): SocialMediaToken
    {
        $token = $this->make();
        $token->user_id ??= ($this->user instanceof UserFactory ? $this->user : UserFactory::new())->create()->id;
        $token->save();

        return $token;
    }

    public function make(): SocialMediaToken
    {
        $token = new SocialMediaToken;
        $token->token = $this->token ?? fake()->uuid();
        $token->user_id = match (true) {
            $this->user instanceof User => $this->user->id,
            is_int($this->user) => $this->user,
            default => null,
        };
        $token->expired_at = $this->expiresAt ?? now()->addMonth();

        return $token;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withExpiresAt(CarbonInterface $expiresAt): self
    {
        return clone ($this, ['expiresAt' => $expiresAt]);
    }

    #[\NoDiscard]
    public function withToken(string $token): self
    {
        return clone ($this, ['token' => $token]);
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return clone ($this, ['user' => $user ?? UserFactory::new()]);
    }
}
