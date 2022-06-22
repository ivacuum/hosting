<?php namespace App\Factory;

use App\Comment;
use App\Domain\CommentStatus;
use App\Issue;
use App\Magnet;
use App\News;

class CommentFactory
{
    private $relId;
    private $userId;
    private $relType;
    private CommentStatus $status = CommentStatus::Published;

    private ?NewsFactory $newsFactory = null;
    private ?MagnetFactory $magnetFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Comment;
        $model->html = fake()->text();
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

    public function withUserId(int $userId)
    {
        $factory = clone $this;
        $factory->userId = $userId;

        return $factory;
    }
}
