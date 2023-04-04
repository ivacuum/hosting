<?php namespace App\Factory;

use App\ChatMessage;
use App\Domain\ChatMessageStatus;
use Carbon\CarbonInterface;

class ChatMessageFactory
{
    private int|null $userId = null;
    private string|null $text = null;
    private ChatMessageStatus $status = ChatMessageStatus::Published;
    private CarbonInterface|null $createdAt = null;

    private ?UserFactory $userFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function hidden()
    {
        return $this->withStatus(ChatMessageStatus::Hidden);
    }

    public function make()
    {
        $model = new ChatMessage;
        $model->ip = fake()->ipv4();
        $model->text = $this->text ?? fake()->sentence(20);
        $model->status = $this->status;
        $model->user_id = $this->userId ?? ($this->userFactory ?? UserFactory::new())->create()->id;
        $model->created_at = $this->createdAt ?? now();

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withCreatedAt(CarbonInterface $createdAt)
    {
        $factory = clone $this;
        $factory->createdAt = $createdAt;

        return $factory;
    }

    public function withStatus(ChatMessageStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }

    public function withText(string $text)
    {
        $factory = clone $this;
        $factory->text = $text;

        return $factory;
    }

    public function withUser(UserFactory $userFactory = null)
    {
        $factory = clone $this;
        $factory->userFactory = $userFactory ?? UserFactory::new();

        return $factory;
    }

    public function withUserId(int $userId)
    {
        $factory = clone $this;
        $factory->userId = $userId;

        return $factory;
    }
}
