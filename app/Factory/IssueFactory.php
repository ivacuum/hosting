<?php namespace App\Factory;

use App\Domain\IssueStatus;
use App\Issue;

class IssueFactory
{
    private const PAGES = [
        '/',
        '/about',
        '/life/kaluga',
        '/en/japanese',
    ];

    private $userId;
    private IssueStatus $status = IssueStatus::Open;

    private ?UserFactory $userFactory = null;
    private ?CommentFactory $commentFactory = null;

    public function closed()
    {
        return $this->withStatus(IssueStatus::Closed);
    }

    public function create()
    {
        $model = $this->make();
        $model->save();

        $this->commentFactory
            ?->withIssueId($model->id)
            ->withUserId($model->user_id)
            ->create();

        return $model;
    }

    public function make()
    {
        $model = new Issue;
        $model->name = fake()->name();
        $model->page = fake()->randomElement(self::PAGES);
        $model->text = fake()->sentence(20);
        $model->email = fake()->safeEmail();
        $model->title = fake()->optional(0.6, 'Default title')->words(4, true);
        $model->status = $this->status;
        $model->user_id = $this->userId;

        if ($this->userFactory && !$model->user_id) {
            $model->user_id = $this->userFactory->withEmail($model->email)->create()->id;
        }

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withComment(CommentFactory $commentFactory = null)
    {
        $factory = clone $this;
        $factory->commentFactory = $commentFactory ?? CommentFactory::new();

        return $factory;
    }

    public function withStatus(IssueStatus $status)
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
}
