<?php

namespace App;

use App\Cast\VocabularyAudioCast;
use App\Domain\VocabularyAudio;
use App\Services\HiraganaRomanizer;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $wk_id
 * @property int $level
 * @property string $character
 * @property string $meaning
 * @property string $kana
 * @property string $sentences
 * @property VocabularyAudio|string $female_audio
 * @property VocabularyAudio|string $male_audio
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 * @property Burnable $burnable
 *
 * @mixin \Eloquent
 */
class Vocabulary extends Model
{
    protected $perPage = 50;

    protected $casts = [
        'level' => 'int',
        'wk_id' => 'int',
        'male_audio' => VocabularyAudioCast::class,
        'female_audio' => VocabularyAudioCast::class,
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

    // Methods
    public function breadcrumb(): string
    {
        return "{$this->character}";
    }

    public function externalLink(): string
    {
        return "https://www.wanikani.com/vocabulary/{$this->character}";
    }

    public function firstKana(): string
    {
        return explode(', ', $this->kana)[0];
    }

    public function toKatakana(): string
    {
        return mb_convert_kana($this->firstKana(), 'C');
    }

    public function toRomaji(): string
    {
        return (new HiraganaRomanizer)->romanize($this->firstKana());
    }

    public function www(): string
    {
        return to('japanese/wanikani/vocabulary/{characters}', $this->character);
    }
}
