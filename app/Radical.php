<?php namespace App;

use App\Http\Controllers\JapaneseWanikaniRadicals;
use App\Traits\BurnsAndResurrects;
use App\Traits\UserBurnableScope;
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
 *
 * @property \App\Burnable $burnable
 * @property \Illuminate\Database\Eloquent\Collection|\App\Kanji[] $kanjis
 *
 * @mixin \Eloquent
 */
class Radical extends Model
{
    use BurnsAndResurrects;
    use UserBurnableScope;

    protected $casts = [
        'level' => 'int',
    ];
    protected $perPage = 50;
    protected $fillable = ['level']; // Чтобы не бросало исключение

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
        return path([JapaneseWanikaniRadicals::class, 'show'], $this->meaning);
    }
}
