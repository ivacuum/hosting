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

    public function create()
    {
        $model = $this->make();
        $model->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;

        if ($this->relationFactory) {
            $relation = $this->relationFactory->create();

            $model->rel_id = $relation->id;
            $model->rel_type = $relation->getMorphClass();
        }

        $model->save();

        return $model;
    }

    public function hidden()
    {
        return $this->withStatus(CommentStatus::Hidden);
    }

    public function make()
    {
        $model = new Comment;
        $model->html = $this->html ?? fake()->text();
        $model->status = $this->status;
        $model->rel_id = $this->relId;
        $model->user_id = $this->userId;
        $model->rel_type = $this->relType;

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function pending()
    {
        return $this->withStatus(CommentStatus::Pending);
    }

    public function withIssue(int|Issue $issue)
    {
        $factory = clone $this;
        $factory->relationFactory = null;

        if ($issue instanceof Issue) {
            $factory->relId = $issue->id;
        } else {
            $factory->relId = $issue;
        }

        $factory->relType = new Issue()->getMorphClass();

        return $factory;
    }

    public function withMagnet(int|Magnet|MagnetFactory|null $magnet = null)
    {
        $factory = clone $this;
        $factory->relationFactory = null;

        if ($magnet instanceof Magnet) {
            $factory->relId = $magnet->id;
            $factory->relType = $magnet->getMorphClass();
        } elseif (is_int($magnet)) {
            $factory->relId = $magnet;
            $factory->relType = new Magnet()->getMorphClass();
        } else {
            $factory->relationFactory = $magnet ?? MagnetFactory::new();
        }

        return $factory;
    }

    public function withNews(int|News|NewsFactory|null $news = null)
    {
        $factory = clone $this;
        $factory->relationFactory = null;

        if ($news instanceof News) {
            $factory->relId = $news->id;
            $factory->relType = $news->getMorphClass();
        } elseif (is_int($news)) {
            $factory->relId = $news;
            $factory->relType = new News()->getMorphClass();
        } else {
            $factory->relationFactory = $news ?? NewsFactory::new();
        }

        return $factory;
    }

    public function withStatus(CommentStatus $status)
    {
        return clone ($this, ['status' => $status]);
    }

    public function withText(string $text)
    {
        return clone ($this, ['html' => $text]);
    }

    public function withTrip(int|Trip $trip)
    {
        $factory = clone $this;
        $factory->relationFactory = null;

        if ($trip instanceof Trip) {
            $factory->relId = $trip->id;
        } else {
            $factory->relId = $trip;
        }

        $factory->relType = (new Trip)->getMorphClass();

        return $factory;
    }

    public function withUser(int|User|UserFactory|null $user = null)
    {
        $factory = clone $this;

        if ($user instanceof User) {
            $factory->userId = $user->id;
        } elseif (is_int($user)) {
            $factory->userId = $user;
        } else {
            $factory->userFactory = $user ?? UserFactory::new();
        }

        return $factory;
    }
}
