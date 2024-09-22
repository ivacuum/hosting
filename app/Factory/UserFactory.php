<?php

namespace App\Factory;

use App\Domain\Locale;
use App\Domain\UserStatus;
use App\User;
use Carbon\CarbonInterface;

class UserFactory
{
    private int|null $id = null;
    private int|null $telegramUserId = null;
    private int|null $magnetShortTitle = 0;
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

    public function english()
    {
        return $this->withLocale(Locale::Eng);
    }

    public function inactive()
    {
        return $this->withStatus(UserStatus::Inactive);
    }

    public function make()
    {
        $user = new User;
        $user->id = $this->id;
        $user->email = $this->email ?? fake()->safeEmail();
        $user->login = $this->login;
        $user->locale = $this->locale->value;
        $user->status = $this->status->value;
        $user->last_login_at = $this->lastLoginAt;
        $user->telegram_id = $this->telegramUserId;
        $user->magnet_short_title = $this->magnetShortTitle;

        if ($this->password) {
            $user->password = $this->password;
        }

        return $user;
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

    public function withLastLoginAt(CarbonInterface|null $lastLoginAt = null)
    {
        $factory = clone $this;
        $factory->lastLoginAt = $lastLoginAt ?? now();

        return $factory;
    }

    public function withLocale(Locale $locale)
    {
        $factory = clone $this;
        $factory->locale = $locale;

        return $factory;
    }

    public function withLogin(string $login)
    {
        $factory = clone $this;
        $factory->login = $login;

        return $factory;
    }

    public function withPassword(#[\SensitiveParameter] string $password): self
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

    public function withTelegramUserId(int $telegramUserId)
    {
        $factory = clone $this;
        $factory->telegramUserId = $telegramUserId;

        return $factory;
    }
}
