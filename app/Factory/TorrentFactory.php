<?php namespace App\Factory;

use App\Torrent;
use Illuminate\Foundation\Testing\WithFaker;

class TorrentFactory
{
    use WithFaker;

    private $title;
    private $categoryId;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Torrent;
        $model->html = '<p>HTML</p>';
        $model->size = $this->faker->numberBetween(1000, 100_000_000_000);
        $model->title = $this->title ?? $this->faker->words(3, true);
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->clicks = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->rto_id = $this->faker->numberBetween(1_000_000, 5_000_000);
        $model->status = Torrent::STATUS_PUBLISHED;
        $model->info_hash = $this->faker->regexify('[A-F0-9]{40}');
        $model->announcer = 'http://example.com';
        $model->registered_at = $this->faker->dateTimeBetween('-4 years');
        $model->related_query = '';

        $model->user_id = UserFactory::new()->create()->id;
        $model->category_id = $this->categoryId ?? $this->faker->randomElement([2, 3, 4, 5, 7, 8, 9, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]);

        return $model;
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withCategoryId(int $categoryId)
    {
        $factory = clone $this;
        $factory->categoryId = $categoryId;

        return $factory;
    }

    public function withTitle(string $title)
    {
        $factory = clone $this;
        $factory->title = $title;

        return $factory;
    }
}
