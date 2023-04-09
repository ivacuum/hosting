<?php namespace App\Factory;

use App\ExternalIdentity;

class ExternalIdentityFactory
{
    private const PROVIDERS = [
        ExternalIdentity::VK,
        ExternalIdentity::GITHUB,
        ExternalIdentity::GOOGLE,
        ExternalIdentity::YANDEX,
        ExternalIdentity::TWITTER,
        ExternalIdentity::FACEBOOK,
    ];

    private int|null $userId = null;
    private string|null $email = null;
    private string|null $provider = null;

    private UserFactory|null $userFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function facebook()
    {
        return $this->withProvider(ExternalIdentity::FACEBOOK);
    }

    public function github()
    {
        return $this->withProvider(ExternalIdentity::GITHUB);
    }

    public function google()
    {
        return $this->withProvider(ExternalIdentity::GOOGLE);
    }

    public function make()
    {
        $model = new ExternalIdentity;
        $model->uid = fake()->numberBetween(10000, 999_999_999_999);
        $model->email = $this->email ?? fake()->optional(0.6, '')->safeEmail();
        $model->user_id = $this->userId ?? ($this->userFactory ?? UserFactory::new())->create()->id;
        $model->provider = $this->provider ?? fake()->randomElement(self::PROVIDERS);

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function twitter()
    {
        return $this->withProvider(ExternalIdentity::TWITTER);
    }

    public function vk()
    {
        return $this->withProvider(ExternalIdentity::VK);
    }

    public function withEmail(string $email)
    {
        $factory = clone $this;
        $factory->email = $email;

        return $factory;
    }

    public function withProvider(string $provider)
    {
        $factory = clone $this;
        $factory->provider = $provider;

        return $factory;
    }

    public function withUser(UserFactory $userFactory)
    {
        $factory = clone $this;
        $factory->userFactory = $userFactory;

        return $factory;
    }

    public function withUserId(int $userId)
    {
        $factory = clone $this;
        $factory->userId = $userId;

        return $factory;
    }

    public function yandex()
    {
        return $this->withProvider(ExternalIdentity::YANDEX);
    }
}
