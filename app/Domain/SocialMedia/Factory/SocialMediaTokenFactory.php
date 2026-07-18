<?php

namespace App\Domain\SocialMedia\Factory;

use App\Domain\SocialMedia\Models\SocialMediaToken;
use App\Factory\UserFactory;
use App\User;
use Carbon\CarbonInterface;

class SocialMediaTokenFactory
{
    private int|null $userId = 1;
    private string|null $token = null;
    private CarbonInterface|null $expiresAt = null;

    private UserFactory|null $userFactory = null;

    public function create(): SocialMediaToken
    {
        $token = $this->make();
        $token->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;
        $token->save();

        return $token;
    }

    public function make(): SocialMediaToken
    {
        $token = new SocialMediaToken;
        $token->token = $this->token ?? fake()->uuid();
        $token->user_id = $this->userId;
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
        return match (true) {
            $user instanceof User => clone ($this, [
                'userId' => $user->id,
                'userFactory' => null,
            ]),
            is_int($user) => clone ($this, [
                'userId' => $user,
                'userFactory' => null,
            ]),
            default => clone ($this, [
                'userId' => null,
                'userFactory' => $user ?? UserFactory::new(),
            ]),
        };
    }
}
