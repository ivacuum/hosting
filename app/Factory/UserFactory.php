<?php namespace App\Factory;

use App\Domain\Locale;
use App\Domain\UserStatus;
use App\User;
use Carbon\CarbonInterface;

class UserFactory
{
    private int|null $id = null;
    private string $login = '';
    private string|null $email = null;
    private string|null $password = null;
    private Locale $locale = Locale::Rus;
    private UserStatus $status = UserStatus::Active;
    private CarbonInterface|null $lastLoginAt = null;

    public function admin()
    {
        return $this->withId(1);
    }

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function inactive()
    {
        return $this->withStatus(UserStatus::Inactive);
    }

    public function make()
    {
        $model = new User;
        $model->id = $this->id;
        $model->email = $this->email ?? fake()->safeEmail();
        $model->login = $this->login;
        $model->locale = $this->locale->value;
        $model->status = $this->status->value;
        $model->last_login_at = $this->lastLoginAt;

        if ($this->password) {
            $model->password = $this->password;
        }

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withEmail(string $email)
    {
        $factory = clone $this;
        $factory->email = $email;

        return $factory;
    }

    public function withId(int $id)
    {
        $factory = clone $this;
        $factory->id = $id;

        return $factory;
    }

    public function withLastLoginAt(CarbonInterface $lastLoginAt = null)
    {
        $factory = clone $this;
        $factory->lastLoginAt = $lastLoginAt ?? now();

        return $factory;
    }

    public function withLogin(string $login)
    {
        $factory = clone $this;
        $factory->login = $login;

        return $factory;
    }

    public function withPassword(string $password): self
    {
        $factory = clone $this;
        $factory->password = $password;

        return $factory;
    }

    public function withStatus(UserStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }
}
