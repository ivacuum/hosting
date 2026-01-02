<?php

namespace App\Domain\Magnet\Factory;

use App\Domain\Magnet\MagnetCategory;
use App\Domain\Magnet\MagnetStatus;
use App\Domain\Magnet\Models\Magnet;
use App\Factory\CommentFactory;
use App\Factory\UserFactory;
use App\User;

class MagnetFactory
{
    private string $relatedQuery = '';
    private int|null $rtoId = null;
    private int|null $userId = null;
    private string|null $html = null;
    private string|null $title = null;
    private MagnetStatus $status = MagnetStatus::Published;
    private MagnetCategory|null $categoryId = null;

    private UserFactory|null $userFactory = null;
    private CommentFactory|null $commentFactory = null;

    public function advancedTitle()
    {
        $factory = clone $this;
        $factory->title = fake()->words(random_int(5, 15), true) . ' (' . fake()->words(2, true) . ') [' . random_int(2000, 2020) . ', RUS]';

        return $factory;
    }

    public function create()
    {
        $model = $this->make();
        $model->save();

        $this->commentFactory
            ?->withMagnet($model)
            ->withUser($model->user_id)
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
        $model->html = $this->html ?? '<p>HTML</p>';
        $model->size = fake()->numberBetween(1000, 100_000_000_000);
        $model->title = $this->title ?? fake()->words(3, true);
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->clicks = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->rto_id = $this->rtoId ?? fake()->numberBetween(1_000_000, 5_000_000);
        $model->status = $this->status;
        $model->user_id = $this->userId ?? ($this->userFactory ?? UserFactory::new())->create()->id;
        $model->info_hash = fake()->regexify('[A-F0-9]{40}');
        $model->announcer = 'https://example.com';
        $model->category_id = $this->categoryId ?? fake()->randomElement([2, 3, 4, 5, 7, 8, 9, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]);
        $model->registered_at = fake()->dateTimeBetween('-4 years');
        $model->related_query = $this->relatedQuery;

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withCategory(MagnetCategory $category)
    {
        $factory = clone $this;
        $factory->categoryId = $category;

        return $factory;
    }

    public function withComment(CommentFactory|null $commentFactory = null)
    {
        $factory = clone $this;
        $factory->commentFactory = $commentFactory ?? CommentFactory::new();

        return $factory;
    }

    public function withHtml(string $html)
    {
        $factory = clone $this;
        $factory->html = $html;

        return $factory;
    }

    public function withRelatedQuery(string $relatedQuery)
    {
        $factory = clone $this;
        $factory->relatedQuery = $relatedQuery;

        return $factory;
    }

    public function withRtoId(int $rtoId)
    {
        $factory = clone $this;
        $factory->rtoId = $rtoId;

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
