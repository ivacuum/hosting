<?php

namespace App\Factory;

use App\Domain\Locale;
use App\Domain\NewsStatus;
use App\News;
use App\User;

class NewsFactory
{
    private int|null $userId = null;
    private string|null $title = null;
    private string|null $markdown = null;
    private Locale $locale = Locale::Rus;
    private NewsStatus $status = NewsStatus::Published;

    private UserFactory|null $userFactory = null;

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
        $model->title = $this->title ?? fake()->words(3, true);
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->locale = $this->locale;
        $model->status = $this->status;
        $model->user_id = $this->userId ?? ($this->userFactory ?? UserFactory::new())->create()->id;
        $model->markdown = $this->markdown ?? fake()->text();

        return $model;
    }

    public static function new(): self
    {
        return new self;
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
