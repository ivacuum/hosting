<?php

namespace App;

use App\Observers\RadicalObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wk_id
 * @property int $level
 * @property string $character
 * @property string $meaning
 * @property string $image
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property Burnable $burnable
 * @property \Illuminate\Database\Eloquent\Collection<int, Kanji> $kanjis
 *
 * @mixin \Eloquent
 */
#[ObservedBy(RadicalObserver::class)]
class Radical extends Model
{
    protected $perPage = 50;

    protected $casts = [
        'level' => 'int',
    ];

    // Relations
    public function burnable()
    {
        return $this->morphOne(Burnable::class, 'rel');
    }

    public function burnables()
    {
        return $this->morphMany(Burnable::class, 'rel');
    }

    public function kanjis()
    {
        return $this->belongsToMany(Kanji::class);
    }

    // Methods
    public function breadcrumb(): string
    {
        return "{$this->character}";
    }

    public function externalLink(): string
    {
        return "https://www.wanikani.com/radicals/{$this->meaning}";
    }

    public function svgContent(): string
    {
        return $this->character
            ? ''
            : file_get_contents(resource_path("svg/wk/{$this->meaning}.svg"));
    }

    public function www(): string
    {
        return to('japanese/wanikani/radicals/{meaning}', $this->meaning);
    }
}
