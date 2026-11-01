<?php

namespace App\Domain\Wanikani\Models;

use App\Domain\Japanese\Action\RomanizeHiraganaAction;
use App\Domain\Wanikani\Cast\VocabularyAudioCast;
use App\Domain\Wanikani\Observer\VocabularyObserver;
use App\Domain\Wanikani\Policy\VocabularyPolicy;
use App\Domain\Wanikani\VocabularyAudio;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
#[ObservedBy(VocabularyObserver::class)]
#[UsePolicy(VocabularyPolicy::class)]
class Vocabulary extends Model
{
    public const array LIST_COLUMNS = ['id', 'level', 'character', 'kana', 'meaning'];

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
        return app(RomanizeHiraganaAction::class)
            ->execute($this->firstKana());
    }

    public function www(): string
    {
        return to('japanese/wanikani/vocabulary/{characters}', $this->character);
    }

    #[\Override]
    protected function casts(): array
    {
        return [
            'level' => 'int',
            'wk_id' => 'int',
            'male_audio' => VocabularyAudioCast::class,
            'female_audio' => VocabularyAudioCast::class,
        ];
    }
}
