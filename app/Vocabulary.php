<?php namespace App;

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
 * @property int $female_audio_id
 * @property int $male_audio_id
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property Burnable $burnable
 *
 * @mixin \Eloquent
 */
class Vocabulary extends Model
{
    use Traits\BurnsAndResurrects;
    use Traits\UserBurnableScope;

    protected $fillable = ['sentences'];
    protected $perPage = 50;

    protected $casts = [
        'level' => 'int',
        'wk_id' => 'int',
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

    public function femaleAudioMp3(): string
    {
        return $this->female_audio_id && $this->wk_id
            ? "https://cdn.wanikani.com/audios/{$this->female_audio_id}-subject-{$this->wk_id}.mp3"
            : '';
    }

    public function firstKana(): string
    {
        return explode(', ', $this->kana)[0];
    }

    public function maleAudioMp3(): string
    {
        return $this->male_audio_id && $this->wk_id
            ? "https://cdn.wanikani.com/audios/{$this->male_audio_id}-subject-{$this->wk_id}.mp3"
            : '';
    }

    public function onlyKanjiCharacters(): string
    {
        return preg_replace('/([ぁ-んァ-ン])/u', '', $this->character);
    }

    public function splitKanjiCharacters(): array
    {
        $str = $this->onlyKanjiCharacters();
        $len = mb_strlen($str);
        $result = [];

        while ($len) {
            $result[] = mb_substr($str, 0, 1);
            $str = mb_substr($str, 1);
            $len--;
        }

        return $result;
    }

    public function toRomaji(): string
    {
        return (new HiraganaRomanizer)->romanize($this->firstKana());
    }

    public function www(): string
    {
        return path([Http\Controllers\JapaneseWanikaniVocabulary::class, 'show'], $this->character);
    }
}
