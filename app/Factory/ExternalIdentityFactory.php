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

    public function create()
    {
        $model = $this->make();
        $model->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;
        $model->save();

        return $model;
    }

    public function facebook()
    {
        return $this->withProvider(ExternalIdentityProvider::Facebook);
    }

    public function github()
    {
        return $this->withProvider(ExternalIdentityProvider::GitHub);
    }

    public function google()
    {
        return $this->withProvider(ExternalIdentityProvider::Google);
    }

    public function make()
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

    public function twitter()
    {
        return $this->withProvider(ExternalIdentityProvider::Twitter);
    }

    public function vk()
    {
        return $this->withProvider(ExternalIdentityProvider::Vk);
    }

    public function withEmail(string $email)
    {
        return clone ($this, ['email' => $email]);
    }

    public function withProvider(ExternalIdentityProvider $provider)
    {
        return clone ($this, ['provider' => $provider]);
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

    public function yandex()
    {
        return $this->withProvider(ExternalIdentityProvider::Yandex);
    }
}
