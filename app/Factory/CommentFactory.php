<?php namespace App\Factory;

use App\Comment;
use App\News;
use Illuminate\Foundation\Testing\WithFaker;

class CommentFactory
{
    use WithFaker;

    private $newsFactory;
    private $torrentFactory;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Comment;
        $model->html = $this->faker->text;
        $model->status = Comment::STATUS_PUBLISHED;
        $model->rel_id = 0;
        $model->user_id = UserFactory::new()->create()->id;
        $model->rel_type = (new News)->getMorphClass();

        if ($this->newsFactory instanceof NewsFactory) {
            $news = $this->newsFactory->create();

            $model->rel_id = $news->id;
            $model->rel_type = $news->getMorphClass();
        }

        if ($this->torrentFactory instanceof TorrentFactory) {
            $torrent = $this->torrentFactory->create();

            $model->rel_id = $torrent->id;
            $model->rel_type = $torrent->getMorphClass();
        }

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withNews(NewsFactory $newsFactory = null)
    {
        $factory = clone $this;
        $factory->newsFactory = $newsFactory ?? NewsFactory::new();

        return $factory;
    }

    public function withTorrent(TorrentFactory $torrentFactory = null)
    {
        $factory = clone $this;
        $factory->torrentFactory = $torrentFactory ?? TorrentFactory::new();

        return $factory;
    }
}
