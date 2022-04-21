<?php namespace App\Factory;

use App\Domain\MagnetStatus;
use App\Magnet;
use Illuminate\Foundation\Testing\WithFaker;

class MagnetFactory
{
    use WithFaker;

    private $title;
    private $status = MagnetStatus::Published;
    private $userId;
    private $categoryId;
    private $relatedQuery = '';

    private ?CommentFactory $commentFactory = null;

    public function advancedTitle()
    {
        $factory = clone $this;
        $factory->title = $this->faker->words(random_int(5, 15), true) . ' (' . $this->faker->words(2, true) . ') [' . random_int(2000, 2020) . ', RUS]';

        return $factory;
    }

    public function create()
    {
        $model = $this->make();
        $model->save();

        $this->commentFactory
            ?->withMagnetId($model->id)
            ->withUserId($model->user_id)
            ->create();

        return $model;
    }

    public function deleted()
    {
        return $this->withStatus(MagnetStatus::Deleted);
    }

    public function hidden()
    {
        return $this->withStatus(MagnetStatus::Hidden);
    }

    public function make()
    {
        $model = new Magnet;
        $model->html = '<p>HTML</p>';
        $model->size = $this->faker->numberBetween(1000, 100_000_000_000);
        $model->title = $this->title ?? $this->faker->words(3, true);
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->clicks = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->rto_id = $this->faker->numberBetween(1_000_000, 5_000_000);
        $model->status = $this->status;
        $model->info_hash = $this->faker->regexify('[A-F0-9]{40}');
        $model->announcer = 'https://example.com';
        $model->registered_at = $this->faker->dateTimeBetween('-4 years');
        $model->related_query = $this->relatedQuery;

        $model->user_id = $this->userId ?? UserFactory::new()->create()->id;
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

    public function withComment(CommentFactory $commentFactory = null)
    {
        $factory = clone $this;
        $factory->commentFactory = $commentFactory ?? CommentFactory::new();

        return $factory;
    }

    public function withRelatedQuery(string $relatedQuery)
    {
        $factory = clone $this;
        $factory->relatedQuery = $relatedQuery;

        return $factory;
    }

    public function withStatus(MagnetStatus $status)
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