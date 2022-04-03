<?php namespace App\Utilities;

use App\Country as Model;
use App\Domain\CacheKey;
use Ivacuum\Generic\Utilities\ModelCacheHelper;

class CountryHelper extends ModelCacheHelper
{
    protected $model;
    protected $cachedFields = [
        'id',
        'title_ru',
        'title_en',
        'slug',
        'emoji',
    ];

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->orderBy = Model::titleField();
    }

    public function cachedByIdKey(): string
    {
        return CacheKey::CountriesById->value;
    }

    public function cachedBySlugKey(): string
    {
        return CacheKey::CountriesBySlug->value;
    }
}
