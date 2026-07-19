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
    private string|null $html = null;
    private string|null $title = null;
    private MagnetStatus $status = MagnetStatus::Published;
    private MagnetCategory|null $categoryId = null;

    private int|User|UserFactory|null $user = null;
    private CommentFactory|null $commentFactory = null;

    #[\NoDiscard]
    public function advancedTitle(): self
    {
        return clone ($this, [
            'title' => fake()->words(random_int(5, 15), true) . ' (' . fake()->words(2, true) . ') [' . random_int(2000, 2020) . ', RUS]',
        ]);
    }

    public function create(): Magnet
    {
        $magnet = $this->make();
        $magnet->user_id ??= ($this->user instanceof UserFactory ? $this->user : UserFactory::new())->create()->id;
        $magnet->save();

        $this->commentFactory
            ?->withMagnet($magnet)
            ->withUser($magnet->user_id)
            ->create();

        return $magnet;
    }

    #[\NoDiscard]
    public function deleted(): self
    {
        return $this->withStatus(MagnetStatus::Deleted);
    }

    #[\NoDiscard]
    public function hidden(): self
    {
        return $this->withStatus(MagnetStatus::Hidden);
    }

    public function make(): Magnet
    {
        $magnet = new Magnet;
        $magnet->html = $this->html ?? '<p>HTML</p>';
        $magnet->size = fake()->numberBetween(1000, 100_000_000_000);
        $magnet->title = $this->title ?? fake()->words(3, true);
        $magnet->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $magnet->clicks = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $magnet->rto_id = $this->rtoId ?? fake()->unique()->numberBetween(3_000_000_000, 4_294_967_295);
        $magnet->status = $this->status;
        $magnet->user_id = match (true) {
            $this->user instanceof User => $this->user->id,
            is_int($this->user) => $this->user,
            default => null,
        };
        $magnet->info_hash = fake()->regexify('[A-F0-9]{40}');
        $magnet->announcer = 'https://example.com';
        $magnet->category_id = $this->categoryId ?? fake()->randomElement([2, 3, 4, 5, 7, 8, 9, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]);
        $magnet->registered_at = fake()->dateTimeBetween('-4 years');
        $magnet->related_query = $this->relatedQuery;

        return $magnet;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withCategory(MagnetCategory $category): self
    {
        return clone ($this, ['categoryId' => $category]);
    }

    #[\NoDiscard]
    public function withComment(CommentFactory|null $commentFactory = null): self
    {
        return clone ($this, ['commentFactory' => $commentFactory ?? CommentFactory::new()]);
    }

    #[\NoDiscard]
    public function withHtml(string $html): self
    {
        return clone ($this, ['html' => $html]);
    }

    #[\NoDiscard]
    public function withRelatedQuery(string $relatedQuery): self
    {
        return clone ($this, ['relatedQuery' => $relatedQuery]);
    }

    #[\NoDiscard]
    public function withRtoId(int $rtoId): self
    {
        return clone ($this, ['rtoId' => $rtoId]);
    }

    #[\NoDiscard]
    public function withStatus(MagnetStatus $status): self
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
        return clone ($this, ['user' => $user ?? UserFactory::new()]);
    }
}
