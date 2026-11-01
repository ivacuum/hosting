<?php

namespace App\Domain\Sphinx;

use App\Domain\Magnet\Models\Magnet;
use Foolz\SphinxQL\Helper;
use Foolz\SphinxQL\SphinxQL;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Scout\Builder;
use Laravel\Scout\Engines\Engine;

class SphinxScoutEngine extends Engine
{
    public function __construct(private SphinxQL $sphinxQl, private Helper $helper) {}

    /** @param Collection<int, Magnet> $models */
    public function update($models): void
    {
        if ($models->isEmpty()) {
            return;
        }

        $model = $models->first();

        $this->ping();

        $query = $this->sphinxQl
            ->replace()
            ->into($model->searchableAs())
            ->columns(array_keys($model->toSearchableArray()));

        $models->each(static function ($model) use ($query) {
            $query->values($model->toSearchableArray());
        });

        $query->execute();
    }

    /** @param Collection<int, Magnet> $models */
    public function delete($models): void
    {
        if ($models->isEmpty()) {
            return;
        }

        $model = $models->first();
        $ids = $models->pluck($model->getKeyName())->values()->all();

        $this->ping();

        $this->sphinxQl
            ->delete()
            ->from($model->searchableAs())
            ->where('id', 'IN', $ids)
            ->execute();
    }

    /** @param Builder<Magnet> $builder */
    public function search(Builder $builder)
    {
        $this->ping();

        $query = $this->sphinxQl
            ->select('id')
            ->from($builder->index ?: $builder->model->searchableAs())
            ->limit($builder->limit ?: 500);

        if ($builder->callback) {
            return call_user_func($builder->callback, $query);
        } else {
            return $query->match('*', $builder->query)
                ->execute();
        }
    }

    public function paginate(Builder $builder, $perPage, $page): never
    {
        throw new \BadMethodCallException('paginate not implemented');
    }

    public function mapIds($results): never
    {
        throw new \BadMethodCallException('mapIds not implemented');
    }

    public function map(Builder $builder, $results, $model): never
    {
        throw new \BadMethodCallException('map not implemented');
    }

    public function getTotalCount($results): never
    {
        throw new \BadMethodCallException('getTotalCount not implemented');
    }

    /** @param Magnet $model */
    public function flush($model): void
    {
        $this->ping();

        $this->helper
            ->truncateRtIndex($model->searchableAs())
            ->execute();
    }

    public function lazyMap(Builder $builder, $results, $model): never
    {
        throw new \BadMethodCallException('lazyMap not implemented');
    }

    public function createIndex($name, array $options = []) {}

    public function deleteIndex($name) {}

    private function ping(): void
    {
        $this->sphinxQl->getConnection()->ping();
    }
}
