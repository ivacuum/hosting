<?php namespace App\Action;

use App\Magnet;
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
            fn ($item) => intval($item) !== $magnet->id
        );
    }
}
