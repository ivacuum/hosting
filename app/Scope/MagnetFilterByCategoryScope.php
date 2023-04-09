<?php namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;

class MagnetFilterByCategoryScope
{
    public function __construct(private int $categoryId)
    {
    }

    public function __invoke(Builder $query)
    {
        $ids = \TorrentCategoryHelper::selfAndDescendantsIds($this->categoryId);

        event(new \App\Events\Stats\TorrentFilteredByCategory);

        return $query->whereIn('category_id', $ids);
    }
}
