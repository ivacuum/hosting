<?php namespace App\Utilities;

use App\CacheKey;
use App\City as Model;
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
        return CacheKey::CITIES_BY_ID;
    }

    public function cachedBySlugKey(): string
    {
        return CacheKey::CITIES_BY_SLUG;
    }
}
