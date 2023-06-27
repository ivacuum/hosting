<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wk_id
 * @property int $level
 * @property string $character
 * @property string $meaning
 * @property string $onyomi
 * @property string $kunyomi
 * @property string $important_reading
 * @property string $nanori
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property Burnable $burnable
 * @property \Illuminate\Database\Eloquent\Collection|Burnable[] $burnables
 * @property \Illuminate\Database\Eloquent\Collection|Radical[] $radicals
 * @property \Illuminate\Database\Eloquent\Collection|Kanji[] $similar
 * @property int $sort
 *
 * @mixin \Eloquent
 */
class Kanji extends Model
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

    public function radicals()
    {
        return $this->belongsToMany(Radical::class);
    }

    public function similar()
    {
        return $this->belongsToMany(static::class, 'kanji_similar', null, 'similar_id');
    }

    // Methods
    public function breadcrumb(): string
    {
        return "{$this->character}";
    }

    public function externalLink(): string
    {
        return "https://www.wanikani.com/kanji/{$this->character}";
    }

    public function firstMeaning(): string
    {
        return explode(', ', $this->meaning)[0];
    }

    public function importantReading(): string
    {
        return $this->important_reading === 'onyomi'
            ? $this->katakanaOnyomi()
            : $this->kunyomi;
    }

    public function katakanaOnyomi(): string
    {
        return mb_convert_kana($this->onyomi, 'C');
    }

    public function www(): string
    {
        return to('japanese/wanikani/kanji/{character}', $this->character);
    }
}
