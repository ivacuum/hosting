<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Артист
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @mixin \Eloquent
 */
class Artist extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    public function breadcrumb(): string
    {
        return $this->title;
    }

    public static function forInputSelect(): Collection
    {
        return static::orderBy('title')->get(['id', 'title'])->pluck('title', 'id');
    }

    public static function forInputSelectJs(): Collection
    {
        return static::orderBy('title')
            ->get(['id', 'title', 'slug'])
            ->map(function (Artist $item) {
                return [
                    'key' => $item->id,
                    'slug' => $item->slug,
                    'value' => $item->title,
                ];
            });
    }
}
