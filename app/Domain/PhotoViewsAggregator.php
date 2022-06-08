<?php namespace App\Domain;

use App\Trip;

class PhotoViewsAggregator
{
    /** @var array<string, int> */
    private array $views = [];

    public function data(): array
    {
        return $this->views;
    }

    public function export(): void
    {
        foreach ($this->views as $slug => $views) {
            \DB::table('photos')
                ->where([
                    'slug' => $slug,
                    'rel_type' => (new Trip)->getMorphClass(),
                ])
                ->increment('views', $views);
        }

        $this->views = [];
    }

    public function push(string $slug): void
    {
        @$this->views[$slug]++;
    }
}
