<?php namespace App\Factory;

use App\User;
use Illuminate\Foundation\Testing\WithFaker;

class UserFactory
{
    use WithFaker;

    private $id;
    private $login;
    private $status;
    private $password;

    public function create(): User
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

    public function make(): User
    {
        $model = new User;
        $model->email = $this->faker->safeEmail;
        $model->login = '';
        $model->locale = 'ru';
        $model->status = $this->status ?? User::STATUS_ACTIVE;

        if ($this->id) {
            $model->id = $this->id;
        }

        if ($this->login) {
            $model->login = $this->login;
        }

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
