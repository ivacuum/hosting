<?php namespace App\Factory;

use App\Domain\Locale;
use App\Domain\NewsStatus;
use App\News;
use Illuminate\Foundation\Testing\WithFaker;

class NewsFactory
{
    use WithFaker;

    private $title;
    private $userId;
    private $markdown;
    private Locale $locale = Locale::Rus;
    private NewsStatus $status = NewsStatus::Published;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function english()
    {
        return $this->withLocale(Locale::Eng);
    }

    public function hidden()
    {
        return $this->withStatus(NewsStatus::Hidden);
    }

    public function make()
    {
        $model = new News;
        $model->title = $this->title ?? $this->faker->words(3, true);
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->locale = $this->locale->value;
        $model->status = $this->status;
        $model->user_id = $this->userId ?? UserFactory::new()->create()->id;
        $model->markdown = $this->markdown ?? $this->faker->text;

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withLocale(Locale $locale)
    {
        $factory = clone $this;
        $factory->locale = $locale;

        return $factory;
    }

    public function withMarkdown(string $markdown)
    {
        $factory = clone $this;
        $factory->markdown = $markdown;

        return $factory;
    }

    public function withStatus(NewsStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }

    public function withTitle(string $title)
    {
        $factory = clone $this;
        $factory->title = $title;

        return $factory;
    }

    public function withUserId(int $userId)
    {
        $factory = clone $this;
        $factory->userId = $userId;

        return $factory;
    }
}
