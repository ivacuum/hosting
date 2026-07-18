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

    public function create(): News
    {
        $news = $this->make();
        $news->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;
        $news->save();

        return $news;
    }

    #[\NoDiscard]
    public function english(): self
    {
        return $this->withLocale(Locale::Eng);
    }

    #[\NoDiscard]
    public function hidden(): self
    {
        return $this->withStatus(NewsStatus::Hidden);
    }

    public function make(): News
    {
        $news = new News;
        $news->title = $this->title ?? fake()->words(3, true);
        $news->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $news->locale = $this->locale;
        $news->status = $this->status;
        $news->user_id = $this->userId;
        $news->markdown = $this->markdown ?? fake()->text();

        return $news;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withLocale(Locale $locale): self
    {
        return clone ($this, ['locale' => $locale]);
    }

    #[\NoDiscard]
    public function withMarkdown(string $markdown): self
    {
        return clone ($this, ['markdown' => $markdown]);
    }

    #[\NoDiscard]
    public function withStatus(NewsStatus $status): self
    {
        return clone ($this, ['status' => $status]);
    }

    #[\NoDiscard]
    public function withTitle(string $title): self
    {
        return clone ($this, ['title' => $title]);
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return match (true) {
            $user instanceof User => clone ($this, [
                'userId' => $user->id,
                'userFactory' => null,
            ]),
            is_int($user) => clone ($this, [
                'userId' => $user,
                'userFactory' => null,
            ]),
            default => clone ($this, [
                'userId' => null,
                'userFactory' => $user ?? UserFactory::new(),
            ]),
        };
    }
}
