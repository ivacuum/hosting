<?php namespace App\Factory;

use App\ExternalIdentity;
use Illuminate\Foundation\Testing\WithFaker;

class ExternalIdentityFactory
{
    use WithFaker;

    private const PROVIDERS = [
        ExternalIdentity::VK,
        ExternalIdentity::GITHUB,
        ExternalIdentity::GOOGLE,
        ExternalIdentity::YANDEX,
        ExternalIdentity::TWITTER,
        ExternalIdentity::FACEBOOK,
    ];

    private $email;
    private $userId;
    private $provider;

    private $userFactory;

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
        $model->uid = $this->faker->numberBetween(10000, 999_999_999_999);
        $model->email = $this->email ?? $this->faker->optional(0.6, '')->safeEmail;
        $model->user_id = $this->userId;
        $model->provider = $this->provider ?? $this->faker->randomElement(self::PROVIDERS);

        if ($this->userFactory instanceof UserFactory && !$model->user_id) {
            $model->user_id = $this->userFactory->create()->id;
        }

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
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

    public function withUser(UserFactory $userFactory = null)
    {
        $factory = clone $this;
        $factory->userFactory = $userFactory ?? UserFactory::new();

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
