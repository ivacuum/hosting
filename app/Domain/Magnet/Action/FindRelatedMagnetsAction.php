<?php

namespace App\Domain\Magnet\Action;

use App\Domain\Magnet\Models\Magnet;
use Foolz\SphinxQL\SphinxQL;
use Illuminate\Container\Attributes\Config;

class FindRelatedMagnetsAction
{
    public function __construct(
        #[Config('scout.driver')]
        private string $scoutDriver,
    ) {}

    public function execute(Magnet $magnet): array
    {
        if (!$magnet->related_query) {
            return [];
        }

        $ids = match ($this->scoutDriver) {
            'sphinx' => $this->sphinx($magnet),
            default => $this->meilisearch($magnet),
        };

        return array_values(array_filter(
            $ids,
            static fn ($item) => $magnet->id !== (int) $item
        ));
    }

    private function meilisearch(Magnet $magnet): array
    {
        return $magnet->search($magnet->related_query)
            ->options(['attributesToSearchOn' => ['title']])
            ->keys()
            ->all();
    }

    private function sphinx(Magnet $magnet): array
    {
        $builder = $magnet->search(
            $magnet->related_query,
            static fn (SphinxQL $builder) => $builder->match('title', $magnet->related_query, true)->execute()
        );

        return \Arr::pluck($builder->raw(), 'id');
    }
}
