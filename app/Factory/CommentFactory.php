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
    private string|null $html = null;
    private string|null $relType = null;
    private CommentStatus $status = CommentStatus::Published;

    private int|Issue|Magnet|MagnetFactory|News|NewsFactory|Trip|null $relation = null;
    private int|User|UserFactory|null $user = null;

    public function create(): Comment
    {
        $comment = $this->make();
        $comment->user_id ??= ($this->user instanceof UserFactory ? $this->user : UserFactory::new())->create()->id;

        if ($this->relation instanceof MagnetFactory || $this->relation instanceof NewsFactory) {
            $relation = $this->relation->create();

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
        $comment->rel_id = match (true) {
            $this->relation instanceof Issue,
            $this->relation instanceof Magnet,
            $this->relation instanceof News,
            $this->relation instanceof Trip => $this->relation->id,
            is_int($this->relation) => $this->relation,
            default => null,
        };
        $comment->user_id = match (true) {
            $this->user instanceof User => $this->user->id,
            is_int($this->user) => $this->user,
            default => null,
        };
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
            'relation' => $issue,
            'relType' => new Issue()->getMorphClass(),
        ]);
    }

    #[\NoDiscard]
    public function withMagnet(int|Magnet|MagnetFactory|null $magnet = null): self
    {
        return clone ($this, [
            'relation' => $magnet ?? MagnetFactory::new(),
            'relType' => match (true) {
                $magnet instanceof Magnet => $magnet->getMorphClass(),
                is_int($magnet) => new Magnet()->getMorphClass(),
                default => null,
            },
        ]);
    }

    #[\NoDiscard]
    public function withNews(int|News|NewsFactory|null $news = null): self
    {
        return clone ($this, [
            'relation' => $news ?? NewsFactory::new(),
            'relType' => match (true) {
                $news instanceof News => $news->getMorphClass(),
                is_int($news) => new News()->getMorphClass(),
                default => null,
            },
        ]);
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
            'relation' => $trip,
            'relType' => new Trip()->getMorphClass(),
        ]);
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return clone ($this, ['user' => $user ?? UserFactory::new()]);
    }
}
