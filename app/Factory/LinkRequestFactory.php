<?php

namespace App\Factory;

use App\LinkRequest;
use App\User;
use Illuminate\Support\Str;

class LinkRequestFactory
{
    private string|null $token = null;

    private int|User|UserFactory|null $user = null;

    public function create(): LinkRequest
    {
        $linkRequest = $this->make();
        $linkRequest->user_id ??= ($this->user instanceof UserFactory ? $this->user : UserFactory::new())->create()->id;
        $linkRequest->save();

        return $linkRequest;
    }

    public function make(): LinkRequest
    {
        $linkRequest = new LinkRequest;
        $linkRequest->token = $this->token ?? Str::random(32);
        $linkRequest->user_id = match (true) {
            $this->user instanceof User => $this->user->id,
            is_int($this->user) => $this->user,
            default => null,
        };

        return $linkRequest;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withToken(string $token): self
    {
        return clone ($this, ['token' => $token]);
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return clone ($this, ['user' => $user ?? UserFactory::new()]);
    }
}
