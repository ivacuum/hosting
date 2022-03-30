<?php namespace App\Factory;

use App\Domain\Locale;
use App\Domain\UserStatus;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;

class UserFactory
{
    use WithFaker;

    private $id;
    private $email;
    private $login = '';
    private $password;
    private Locale $locale = Locale::Rus;
    private UserStatus $status = UserStatus::Active;

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
        $model->email = $this->email ?? $this->faker->safeEmail;
        $model->login = $this->login;
        $model->locale = $this->locale->value;
        $model->status = $this->status->value;

        if ($this->password) {
            $model->password = $this->password;
        }

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
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
