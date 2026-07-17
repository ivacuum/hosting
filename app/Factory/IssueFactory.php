<?php

namespace App\Factory;

use App\Domain\IssueStatus;
use App\Issue;
use App\User;

class IssueFactory
{
    private const array PAGES = [
        '/',
        '/about',
        '/life/kaluga',
        '/en/japanese',
    ];

    private int|null $userId = null;
    private string|null $text = null;
    private string|null $email = null;
    private string|null $title = null;
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
        $model->user_id ??= ($this->userFactory ?? UserFactory::new())
            ->withEmail($model->email)
            ->create()
            ->id;
        $model->save();

        $this->commentFactory
            ?->withIssue($model)
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
        $model->user_id = $this->userId;

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withComment(CommentFactory|null $commentFactory = null)
    {
        return clone ($this, ['commentFactory' => $commentFactory ?? CommentFactory::new()]);
    }

    public function withStatus(IssueStatus $status)
    {
        return clone ($this, ['status' => $status]);
    }

    public function withText(string $text)
    {
        return clone ($this, ['text' => $text]);
    }

    public function withTitle(string $title)
    {
        return clone ($this, ['title' => $title]);
    }

    public function withUser(int|User|UserFactory|null $user = null)
    {
        $factory = clone $this;

        if ($user instanceof User) {
            $factory->email = $user->email;
            $factory->userId = $user->id;
        } elseif (is_int($user)) {
            $factory->userId = $user;
        } else {
            $factory->userFactory = $user ?? UserFactory::new();
        }

        return $factory;
    }
}
