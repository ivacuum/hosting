<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @mixin \Eloquent
 */
class Artist extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    // Relations
    public function gigs()
    {
        return $this->hasMany(Gig::class)
            ->orderByDesc('date');
    }

    public function breadcrumb(): string
    {
        return $this->title;
    }

    public static function forInputSelect(): Collection
    {
        return static::orderBy('title')->pluck('title', 'id');
    }
}
