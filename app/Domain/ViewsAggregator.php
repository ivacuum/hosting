<?php

namespace App\Domain;

class ViewsAggregator
{
    use PingsDatabase;

    private $views = [];

    public function data(): array
    {
        return $this->views;
    }

    public function export(): void
    {
        $this->pingDatabase();

        foreach ($this->views as $table => $views) {
            $ids = [];
            $sql = '';

            foreach ($views as $id => $count) {
                $ids[] = $id;
                $sql .= sprintf('WHEN %d THEN %d ', $id, $count);
            }

            $this->views[$table] = [];

            if (!$sql) {
                continue;
            }

            $ids = implode(', ', $ids);

            \DB::statement("UPDATE {$table} SET views = views + (CASE id {$sql}END) WHERE id IN ({$ids})");
        }
    }

    public function push(string $table, int $id): void
    {
        @$this->views[$table][$id]++;
    }
}
