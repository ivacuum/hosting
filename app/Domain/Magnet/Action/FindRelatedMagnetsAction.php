<?php

namespace App\Domain\Magnet\Action;

use App\Domain\Magnet\Models\Magnet;
use Foolz\SphinxQL\SphinxQL;

class FindRelatedMagnetsAction
{
    public function execute(Magnet $magnet): array
    {
        if (!$magnet->related_query) {
            return [];
        }

        $builder = $magnet->search(
            $magnet->related_query,
            fn (SphinxQL $builder) => $builder->match('title', $magnet->related_query, true)->execute()
        );

        return array_filter(
            \Arr::pluck($builder->raw(), 'id'),
            fn ($item) => $magnet->id !== intval($item)
        );
    }
}
