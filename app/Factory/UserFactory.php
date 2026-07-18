<?php

namespace App\Factory;

use App\Domain\Locale;
use App\Domain\UserStatus;
use App\User;
use Carbon\CarbonInterface;

class UserFactory
{
    private bool $root = false;
    private int|null $id = null;
    private int|null $telegramUserId = null;
    private int|null $magnetShortTitle = 0;
    private string|null $email = null;
    private string|null $login = null;
    private string|null $password = null;
    private Locale $locale = Locale::Rus;
    private UserStatus $status = UserStatus::Active;
    private CarbonInterface|null $lastLoginAt = null;

    public function create(): User
    {
        $user = $this->make();
        $user->save();

        return $user;
    }

    #[\NoDiscard]
    public function english(): self
    {
        return $this->withLocale(Locale::Eng);
    }

    #[\NoDiscard]
    public function inactive(): self
    {
        return $this->withStatus(UserStatus::Inactive);
    }

    public function make(): User
    {
        $user = new User;
        $user->id = $this->id;
        $user->root = $this->root;
        $user->email = $this->email ?? fake()->uuid() . '@example.com';
        $user->login = $this->login;
        $user->locale = $this->locale->value;
        $user->status = $this->status;
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

    #[\NoDiscard]
    public function root(): self
    {
        return $this->withRoot();
    }

    #[\NoDiscard]
    public function withEmail(string $email): self
    {
        return clone ($this, ['email' => $email]);
    }

    #[\NoDiscard]
    public function withId(int $id): self
    {
        return clone ($this, ['id' => $id]);
    }

    #[\NoDiscard]
    public function withLastLoginAt(CarbonInterface|null $lastLoginAt = null): self
    {
        return clone ($this, ['lastLoginAt' => $lastLoginAt ?? now()]);
    }

    #[\NoDiscard]
    public function withLocale(Locale $locale): self
    {
        return clone ($this, ['locale' => $locale]);
    }

    #[\NoDiscard]
    public function withLogin(string $login): self
    {
        return clone ($this, ['login' => $login]);
    }

    #[\NoDiscard]
    public function withPassword(#[\SensitiveParameter] string $password): self
    {
        return clone ($this, ['password' => $password]);
    }

    #[\NoDiscard]
    public function withRoot(bool $isRoot = true): self
    {
        return clone ($this, ['root' => $isRoot]);
    }

    #[\NoDiscard]
    public function withStatus(UserStatus $status): self
    {
        return clone ($this, ['status' => $status]);
    }

    #[\NoDiscard]
    public function withTelegramUserId(int $telegramUserId): self
    {
        return clone ($this, ['telegramUserId' => $telegramUserId]);
    }
}
