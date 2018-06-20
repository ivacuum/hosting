<?php namespace App\Utilities;

use App\CacheKey;
use App\City as Model;
use Ivacuum\Generic\Utilities\ModelCacheHelper;

/**
 * @method Model findById(int $id)
 * @method Model findByIdOrFail(int $id)
 * @method Model findBySlug(?string $slug)
 * @method Model findBySlugOrFail(?string $slug)
 */
class CityHelper extends ModelCacheHelper
{
    const CACHED_BY_ID_KEY = CacheKey::CITIES_BY_ID;
    const CACHED_BY_SLUG_KEY = CacheKey::CITIES_BY_SLUG;

    protected $model;

    protected $cached_fields = [
        'id',
        'country_id',
        'title_ru',
        'title_en',
        'slug',
        'iata',
        'lat',
        'lon',
    ];

    protected static $cached_id;
    protected static $cached_slug;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->order_by = Model::titleField();
    }
}
