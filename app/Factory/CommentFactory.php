<?php

namespace App\Factory;

use App\Comment;
use App\Domain\CommentStatus;
use App\Domain\Life\Models\Trip;
use App\Domain\Magnet\Factory\MagnetFactory;
use App\Domain\Magnet\Models\Magnet;
use App\Issue;
use App\News;
use App\User;

class CommentFactory
{
    private int|null $relId = null;
    private int|null $userId = null;
    private string|null $html = null;
    private string|null $relType = null;
    private CommentStatus $status = CommentStatus::Published;

    private UserFactory|null $userFactory = null;
    private NewsFactory|MagnetFactory|null $relationFactory = null;

    public function create(): Comment
    {
        $comment = $this->make();
        $comment->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;

        if ($this->relationFactory) {
            $relation = $this->relationFactory->create();

            $comment->rel_id = $relation->id;
            $comment->rel_type = $relation->getMorphClass();
        }

        $comment->save();

        return $comment;
    }

    #[\NoDiscard]
    public function hidden(): self
    {
        return $this->withStatus(CommentStatus::Hidden);
    }

    public function make(): Comment
    {
        $comment = new Comment;
        $comment->html = $this->html ?? fake()->text();
        $comment->status = $this->status;
        $comment->rel_id = $this->relId;
        $comment->user_id = $this->userId;
        $comment->rel_type = $this->relType;

        return $comment;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function pending(): self
    {
        return $this->withStatus(CommentStatus::Pending);
    }

    #[\NoDiscard]
    public function withIssue(int|Issue $issue): self
    {
        return clone ($this, [
            'relId' => $issue instanceof Issue ? $issue->id : $issue,
            'relType' => new Issue()->getMorphClass(),
            'relationFactory' => null,
        ]);
    }

    #[\NoDiscard]
    public function withMagnet(int|Magnet|MagnetFactory|null $magnet = null): self
    {
        return match (true) {
            $magnet instanceof Magnet => clone ($this, [
                'relId' => $magnet->id,
                'relType' => $magnet->getMorphClass(),
                'relationFactory' => null,
            ]),
            is_int($magnet) => clone ($this, [
                'relId' => $magnet,
                'relType' => new Magnet()->getMorphClass(),
                'relationFactory' => null,
            ]),
            default => clone ($this, [
                'relId' => null,
                'relType' => null,
                'relationFactory' => $magnet ?? MagnetFactory::new(),
            ]),
        };
    }

    #[\NoDiscard]
    public function withNews(int|News|NewsFactory|null $news = null): self
    {
        return match (true) {
            $news instanceof News => clone ($this, [
                'relId' => $news->id,
                'relType' => $news->getMorphClass(),
                'relationFactory' => null,
            ]),
            is_int($news) => clone ($this, [
                'relId' => $news,
                'relType' => new News()->getMorphClass(),
                'relationFactory' => null,
            ]),
            default => clone ($this, [
                'relId' => null,
                'relType' => null,
                'relationFactory' => $news ?? NewsFactory::new(),
            ]),
        };
    }

    #[\NoDiscard]
    public function withStatus(CommentStatus $status): self
    {
        return clone ($this, ['status' => $status]);
    }

    #[\NoDiscard]
    public function withText(string $text): self
    {
        return clone ($this, ['html' => $text]);
    }

    #[\NoDiscard]
    public function withTrip(int|Trip $trip): self
    {
        return clone ($this, [
            'relId' => $trip instanceof Trip ? $trip->id : $trip,
            'relType' => (new Trip)->getMorphClass(),
            'relationFactory' => null,
        ]);
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
