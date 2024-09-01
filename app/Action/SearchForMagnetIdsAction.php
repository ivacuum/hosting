<?php

namespace App\Action;

use App\Magnet;
use App\SearchSynonym;
use Foolz\SphinxQL\SphinxQL;
use Illuminate\Container\Attributes\Config;
use Laravel\Scout\Builder;

class SearchForMagnetIdsAction
{
    public function __construct(
        #[Config('scout.driver')]
        private string $scoutDriver,
    ) {}

    public function execute(string $q, int|null $categoryId, bool $fulltext): mixed
    {
        return match ($this->scoutDriver) {
            'sphinx' => $this->sphinx($q, $categoryId, $fulltext),
            default => $this->meilisearch($q, $categoryId, $fulltext),
        };
    }

    private function meilisearch(string $q, int|null $categoryId, bool $fulltext)
    {
        return Magnet::search($q)
            ->options([
                'attributesToRetrieve' => ['id'],
                'attributesToSearchOn' => $fulltext
                    ? ['title', 'text']
                    : ['title'],
            ])
            ->when($categoryId, fn (Builder $query) => $query->whereIn('category_id', \TorrentCategoryHelper::selfAndDescendantsIds($categoryId)))
            ->raw()['hits'];
    }

    private function sphinx(string $q, int|null $categoryId, bool $fulltext)
    {
        return Magnet::search($q, function (SphinxQL $builder) use ($categoryId, $fulltext, $q) {
            $builder = $builder->match(
                $fulltext ? '*' : 'title',
                SearchSynonym::addSynonymsToQuery($q),
                true
            );

            if ($categoryId) {
                $builder = $builder->where('category_id', '=', $categoryId);
            }

            return $builder->execute();
        })->raw();
    }
}
