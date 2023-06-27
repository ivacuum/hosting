<?php

namespace App\Factory;

use App\Comment;
use App\Domain\CommentStatus;
use App\Issue;
use App\Magnet;
use App\News;
use App\Trip;

class CommentFactory
{
    private int|null $relId = null;
    private int|null $userId = null;
    private string|null $html = null;
    private string|null $relType = null;
    private CommentStatus $status = CommentStatus::Published;

    private NewsFactory|null $newsFactory = null;
    private MagnetFactory|null $magnetFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Comment;
        $model->html = $this->html ?? fake()->text();
        $model->status = $this->status;
        $model->rel_id = $this->relId ?? 0;
        $model->user_id = $this->userId ?? UserFactory::new()->create()->id;
        $model->rel_type = $this->relType ?? (new News)->getMorphClass();

        if ($this->newsFactory) {
            $news = $this->newsFactory->create();

            $model->rel_id = $news->id;
            $model->rel_type = $news->getMorphClass();
        }

        if ($this->magnetFactory) {
            $magnet = $this->magnetFactory->create();

            $model->rel_id = $magnet->id;
            $model->rel_type = $magnet->getMorphClass();
        }

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withIssueId(int $issueId)
    {
        $factory = clone $this;
        $factory->relId = $issueId;
        $factory->relType = (new Issue)->getMorphClass();

        return $factory;
    }

    public function withMagnet(MagnetFactory $magnetFactory = null)
    {
        $factory = clone $this;
        $factory->magnetFactory = $magnetFactory ?? MagnetFactory::new();

        return $factory;
    }

    public function withMagnetId(int $magnetId)
    {
        $factory = clone $this;
        $factory->relId = $magnetId;
        $factory->relType = (new Magnet)->getMorphClass();

        return $factory;
    }

    public function withNews(NewsFactory $newsFactory = null)
    {
        $factory = clone $this;
        $factory->newsFactory = $newsFactory ?? NewsFactory::new();

        return $factory;
    }

    public function withText(string $text)
    {
        $factory = clone $this;
        $factory->html = $text;

        return $factory;
    }

    public function withTripId(int $tripId)
    {
        $factory = clone $this;
        $factory->relId = $tripId;
        $factory->relType = (new Trip)->getMorphClass();

        return $factory;
    }

    public function withUserId(int $userId)
    {
        $factory = clone $this;
        $factory->userId = $userId;

        return $factory;
    }
}
