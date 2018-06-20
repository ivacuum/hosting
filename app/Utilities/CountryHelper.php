<?php namespace App\Utilities;

use App\CacheKey;
use App\Country as Model;
use Ivacuum\Generic\Utilities\ModelCacheHelper;

/**
 * @method Model findById(int $id)
 * @method Model findByIdOrFail(int $id)
 * @method Model findBySlug(?string $slug)
 * @method Model findBySlugOrFail(?string $slug)
 */
class CountryHelper extends ModelCacheHelper
{
    const CACHED_BY_ID_KEY = CacheKey::COUNTRIES_BY_ID;
    const CACHED_BY_SLUG_KEY = CacheKey::COUNTRIES_BY_SLUG;

    protected $model;

    protected $cached_fields = [
        'id',
        'title_ru',
        'title_en',
        'slug',
        'emoji',
    ];

    protected static $cached_id;
    protected static $cached_slug;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->order_by = Model::titleField();
    }
}
