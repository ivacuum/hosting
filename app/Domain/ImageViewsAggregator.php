<?php namespace App\Domain;

use App\Action\PingDatabaseAction;

class ImageViewsAggregator
{
    /** @var array<string, int> */
    private array $views = [];

    public function __construct(private PingDatabaseAction $pingDatabase)
    {
    }

    public function data(): array
    {
        return $this->views;
    }

    public function export(): void
    {
        $this->pingDatabase->execute();

        foreach ($this->views as $dateAndSlug => $views) {
            [$date, $slug] = explode('/', $dateAndSlug);

            \DB::table('images')
                ->where([
                    'date' => $date,
                    'slug' => $slug,
                ])
                ->increment('views', $views, [
                    'updated_at' => now()->toDateTimeString(),
                ]);
        }

        $this->views = [];
    }

    public function push(string $dateAndSlug): void
    {
        @$this->views[$dateAndSlug]++;
    }
}
