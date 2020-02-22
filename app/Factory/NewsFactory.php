<?php namespace App\Factory;

use App\News;
use Illuminate\Foundation\Testing\WithFaker;

class NewsFactory
{
    use WithFaker;

    private $locale = 'ru';
    private $userId;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new News;
        $model->title = $this->faker->words(3, true);
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->locale = $this->locale;
        $model->status = News::STATUS_PUBLISHED;
        $model->user_id = $this->userId ?? UserFactory::new()->create()->id;
        $model->markdown = $this->faker->text;

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withLocale(string $locale)
    {
        $factory = clone $this;
        $factory->locale = $locale;

        return $factory;
    }

    public function withUserId(int $userId)
    {
        $factory = clone $this;
        $factory->userId = $userId;

        return $factory;
    }
}
