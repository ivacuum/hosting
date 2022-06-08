<?php namespace App\Domain;

class ViewsAggregator
{
    /** @var array<string, array<int, int>> */
    private array $views = [];

    public function data(): array
    {
        return $this->views;
    }

    public function export(): void
    {
        foreach ($this->views as $table => $views) {
            $ids = [];
            $cases = '';

            foreach ($views as $id => $count) {
                $ids[] = $id;
                $cases .= sprintf('WHEN %d THEN %d ', $id, $count);
            }

            $this->views[$table] = [];

            if (!$cases) {
                continue;
            }

            \DB::table($table)
                ->whereIn('id', $ids)
                ->update([
                    'views' => \DB::raw("views + (CASE id {$cases} END)"),
                ]);
        }
    }

    public function push(string $table, int $id): void
    {
        @$this->views[$table][$id]++;
    }
}
