<?php namespace App\Factory;

use App\Domain\IssueStatus;
use App\Issue;
use App\User;

class IssueFactory
{
    private const PAGES = [
        '/',
        '/about',
        '/life/kaluga',
        '/en/japanese',
    ];

    private $text;
    private $email;
    private $title;
    private $userId;
    private IssueStatus $status = IssueStatus::Open;

    private UserFactory|null $userFactory = null;
    private CommentFactory|null $commentFactory = null;

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
            ->create();

        return $model;
    }

    public function make()
    {
        $model = new Issue;
        $model->name = fake()->name();
        $model->page = fake()->randomElement(self::PAGES);
        $model->text = $this->text ?? fake()->sentence(20);
        $model->email = $this->email ?? fake()->safeEmail();
        $model->title = $this->title ?? fake()->optional(0.6, 'Default title')->words(4, true);
        $model->status = $this->status;
        $model->user_id = $this->userId ?? $this->userFactory?->withEmail($model->email)->create()->id;

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

    public function withText(string $text)
    {
        $factory = clone $this;
        $factory->text = $text;

        return $factory;
    }

    public function withTitle(string $title)
    {
        $factory = clone $this;
        $factory->title = $title;

        return $factory;
    }

    public function withUser(User|UserFactory $user = null)
    {
        $factory = clone $this;

        if ($user instanceof User) {
            $factory->email = $user->email;
            $factory->userId = $user->id;
        } else {
            $factory->userFactory = $user ?? UserFactory::new();
        }

        return $factory;
    }
}
