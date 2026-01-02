<?php

namespace App\Factory;

use App\LinkRequest;
use App\User;
use Illuminate\Support\Str;

class LinkRequestFactory
{
    private int|null $userId = null;
    private string|null $token = null;

    private UserFactory|null $userFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $linkRequest = new LinkRequest;
        $linkRequest->token = $this->token ?? Str::random(32);
        $linkRequest->user_id = $this->userId ?? ($this->userFactory ?? UserFactory::new())->create()->id;

        return $linkRequest;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withToken(string $token)
    {
        $factory = clone $this;
        $factory->token = $token;

        return $factory;
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
}
