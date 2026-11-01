<?php

namespace App\Domain\Wanikani\Models;

use App\Domain\Wanikani\Observer\RadicalObserver;
use App\Domain\Wanikani\Policy\RadicalPolicy;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property int $id
 * @property int $wk_id
 * @property int $level
 * @property string $character
 * @property string $meaning
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property Burnable $burnable
 * @property \Illuminate\Database\Eloquent\Collection<int, Kanji> $kanjis
 *
 * @mixin \Eloquent
 */
#[ObservedBy(RadicalObserver::class)]
#[UsePolicy(RadicalPolicy::class)]
class Radical extends Model
{
    public const array LIST_COLUMNS = ['id', 'level', 'character', 'meaning'];

    // Relations
    /** @return MorphOne<Burnable, $this> */
    public function burnable(): MorphOne
    {
        return $this->morphOne(Burnable::class, 'rel');
    }

    public function burnables(): MorphMany
    {
        return $this->morphMany(Burnable::class, 'rel');
    }

    public function kanjis(): BelongsToMany
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

    public function www(): string
    {
        return to('japanese/wanikani/radicals/{meaning}', $this->meaning);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'level' => 'int',
        ];
    }
}
