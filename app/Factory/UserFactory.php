<?php namespace App\Factory;

use App\User;
use Illuminate\Foundation\Testing\WithFaker;

class UserFactory
{
    use WithFaker;

    private $id;
    private $email;
    private $login = '';
    private $locale = 'ru';
    private $status = User::STATUS_ACTIVE;
    private $password;

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
        $factory = clone $this;
        $factory->status = User::STATUS_INACTIVE;

        return $factory;
    }

    public function make()
    {
        $model = new User;
        $model->id = $this->id;
        $model->email = $this->email ?? $this->faker->safeEmail;
        $model->login = $this->login;
        $model->locale = $this->locale;
        $model->status = $this->status;

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
}
