<?php namespace App\Utilities;

use App\City as Model;
use App\Domain\CacheKey;
use Ivacuum\Generic\Utilities\ModelCacheHelper;

class CityHelper extends ModelCacheHelper
{
    protected $model;
    protected $cachedFields = [
        'id',
        'country_id',
        'title_ru',
        'title_en',
        'slug',
        'iata',
        'lat',
        'lon',
        'point',
    ];

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->orderBy = Model::titleField();
    }

    public function cachedByIdKey(): string
    {
        return CacheKey::CitiesById->value;
    }

    public function cachedBySlugKey(): string
    {
        return CacheKey::CitiesBySlug->value;
    }
}
