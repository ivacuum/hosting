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

    #[\NoDiscard]
    public function closed(): self
    {
        return $this->withStatus(IssueStatus::Closed);
    }

    public function create(): Issue
    {
        $issue = $this->make();
        $issue->user_id ??= ($this->userFactory ?? UserFactory::new())
            ->withEmail($issue->email)
            ->create()
            ->id;
        $issue->save();

        $this->commentFactory
            ?->withIssue($issue)
            ->create();

        return $issue;
    }

    public function make(): Issue
    {
        $issue = new Issue;
        $issue->name = fake()->name();
        $issue->page = fake()->randomElement(self::PAGES);
        $issue->text = $this->text ?? fake()->sentence(20);
        $issue->email = $this->email ?? fake()->safeEmail();
        $issue->title = $this->title ?? fake()->optional(0.6, 'Default title')->words(4, true);
        $issue->status = $this->status;
        $issue->user_id = $this->userId;

        return $issue;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withComment(CommentFactory|null $commentFactory = null): self
    {
        return clone ($this, ['commentFactory' => $commentFactory ?? CommentFactory::new()]);
    }

    #[\NoDiscard]
    public function withStatus(IssueStatus $status): self
    {
        return clone ($this, ['status' => $status]);
    }

    #[\NoDiscard]
    public function withText(string $text): self
    {
        return clone ($this, ['text' => $text]);
    }

    #[\NoDiscard]
    public function withTitle(string $title): self
    {
        return clone ($this, ['title' => $title]);
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return match (true) {
            $user instanceof User => clone ($this, [
                'email' => $user->email,
                'userId' => $user->id,
                'userFactory' => null,
            ]),
            is_int($user) => clone ($this, [
                'email' => null,
                'userId' => $user,
                'userFactory' => null,
            ]),
            default => clone ($this, [
                'email' => null,
                'userId' => null,
                'userFactory' => $user ?? UserFactory::new(),
            ]),
        };
    }
}
