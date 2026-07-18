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

    public function create(): LinkRequest
    {
        $linkRequest = $this->make();
        $linkRequest->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;
        $linkRequest->save();

        return $linkRequest;
    }

    public function make(): LinkRequest
    {
        $linkRequest = new LinkRequest;
        $linkRequest->token = $this->token ?? Str::random(32);
        $linkRequest->user_id = $this->userId;

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
        return match (true) {
            $user instanceof User => clone ($this, [
                'userId' => $user->id,
                'userFactory' => null,
            ]),
            is_int($user) => clone ($this, [
                'userId' => $user,
                'userFactory' => null,
            ]),
            default => clone ($this, [
                'userId' => null,
                'userFactory' => $user ?? UserFactory::new(),
            ]),
        };
    }
}
