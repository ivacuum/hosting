<?php

namespace App\Factory;

use App\Domain\ExternalIdentityProvider;
use App\ExternalIdentity;
use App\User;

class ExternalIdentityFactory
{
    private int|null $userId = null;
    private string|null $email = null;
    private ExternalIdentityProvider|null $provider = null;

    private UserFactory|null $userFactory = null;

    public function create(): ExternalIdentity
    {
        $externalIdentity = $this->make();
        $externalIdentity->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;
        $externalIdentity->save();

        return $externalIdentity;
    }

    #[\NoDiscard]
    public function facebook(): self
    {
        return $this->withProvider(ExternalIdentityProvider::Facebook);
    }

    #[\NoDiscard]
    public function github(): self
    {
        return $this->withProvider(ExternalIdentityProvider::GitHub);
    }

    #[\NoDiscard]
    public function google(): self
    {
        return $this->withProvider(ExternalIdentityProvider::Google);
    }

    public function make(): ExternalIdentity
    {
        $externalIdentity = new ExternalIdentity;
        $externalIdentity->uid = fake()->numberBetween(10000, 999_999_999_999);
        $externalIdentity->email = $this->email ?? fake()->optional(0.6, '')->safeEmail();
        $externalIdentity->user_id = $this->userId;
        $externalIdentity->provider = $this->provider ?? fake()->randomElement(ExternalIdentityProvider::class);

        return $externalIdentity;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function twitter(): self
    {
        return $this->withProvider(ExternalIdentityProvider::Twitter);
    }

    #[\NoDiscard]
    public function vk(): self
    {
        return $this->withProvider(ExternalIdentityProvider::Vk);
    }

    #[\NoDiscard]
    public function withEmail(string $email): self
    {
        return clone ($this, ['email' => $email]);
    }

    #[\NoDiscard]
    public function withProvider(ExternalIdentityProvider $provider): self
    {
        return clone ($this, ['provider' => $provider]);
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

    #[\NoDiscard]
    public function yandex(): self
    {
        return $this->withProvider(ExternalIdentityProvider::Yandex);
    }
}
