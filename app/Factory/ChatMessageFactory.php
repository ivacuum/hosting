<?php namespace App\Factory;

use App\ChatMessage;
use App\Domain\ChatMessageStatus;
use Illuminate\Foundation\Testing\WithFaker;

class ChatMessageFactory
{
    use WithFaker;

    private $userId;
    private ChatMessageStatus $status = ChatMessageStatus::Published;

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
        $model->ip = $this->faker->ipv4;
        $model->text = $this->faker->sentence(20);
        $model->status = $this->status;
        $model->user_id = $this->userId;

        if (!$model->user_id) {
            $model->user_id = ($this->userFactory ?? UserFactory::new())->create()->id;
        }

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withStatus(ChatMessageStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

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
