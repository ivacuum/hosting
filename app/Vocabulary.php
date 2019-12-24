<?php namespace App;

use App\Http\Controllers\JapaneseWanikaniVocabulary;
use App\Traits\BurnsAndResurrects;
use App\Traits\UserBurnableScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Словарное слово
 *
 * @property int $id
 * @property int $wk_id
 * @property int $level
 * @property string  $character
 * @property string  $meaning
 * @property string  $kana
 * @property string  $sentences
 * @property \Carbon\CarbonImmutable $created_at
 * @property \Carbon\CarbonImmutable $updated_at
 *
 * @property \App\Burnable $burnable
 *
 * @mixin \Eloquent
 */
class Vocabulary extends Model
{
    use BurnsAndResurrects;
    use UserBurnableScope;

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
    public function audioMp3(): string
    {
        return $this->wk_id
            ? "https://cdn.wanikani.com/subjects/audio/{$this->wk_id}-{$this->character}.mp3"
            : '';
    }

    public function breadcrumb(): string
    {
        return "{$this->character}";
    }

    public function externalLink(): string
    {
        return "https://www.wanikani.com/vocabulary/{$this->character}";
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

    public function www(): string
    {
        return path([JapaneseWanikaniVocabulary::class, 'show'], $this->character);
    }
}
