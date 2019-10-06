<?php namespace App\Utilities;

use App\CacheKey;
use App\Country as Model;
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
        return CacheKey::COUNTRIES_BY_ID;
    }

    public function cachedBySlugKey(): string
    {
        return CacheKey::COUNTRIES_BY_SLUG;
    }
}
