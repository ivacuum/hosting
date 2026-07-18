<?php

namespace App\Factory;

use App\ChatMessage;
use App\Domain\ChatMessageStatus;
use App\User;
use Carbon\CarbonInterface;

class ChatMessageFactory
{
    private int|null $userId = null;
    private string|null $text = null;
    private ChatMessageStatus $status = ChatMessageStatus::Published;
    private CarbonInterface|null $createdAt = null;

    private UserFactory|null $userFactory = null;

    public function create(): ChatMessage
    {
        $chatMessage = $this->make();
        $chatMessage->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;
        $chatMessage->save();

        return $chatMessage;
    }

    #[\NoDiscard]
    public function hidden(): self
    {
        return $this->withStatus(ChatMessageStatus::Hidden);
    }

    public function make(): ChatMessage
    {
        $chatMessage = new ChatMessage;
        $chatMessage->ip = fake()->ipv4();
        $chatMessage->text = $this->text ?? fake()->sentence(20);
        $chatMessage->status = $this->status;
        $chatMessage->user_id = $this->userId;
        $chatMessage->created_at = $this->createdAt ?? now();

        return $chatMessage;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withCreatedAt(CarbonInterface $createdAt): self
    {
        return clone ($this, ['createdAt' => $createdAt]);
    }

    #[\NoDiscard]
    public function withStatus(ChatMessageStatus $status): self
    {
        return clone ($this, ['status' => $status]);
    }

    #[\NoDiscard]
    public function withText(string $text): self
    {
        return clone ($this, ['text' => $text]);
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
