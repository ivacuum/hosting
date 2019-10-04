<?php namespace App;

use App\Traits\BurnsAndResurrects;
use App\Traits\UserBurnableScope;
use Illuminate\Database\Eloquent\Model;

/**
 * Ключ
 *
 * @property int $id
 * @property int $level
 * @property string $character
 * @property string $meaning
 * @property string $image
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \App\Burnable $burnable
 * @property \Illuminate\Database\Eloquent\Collection|\App\Kanji[] $kanjis
 *
 * @mixin \Eloquent
 */
class Radical extends Model
{
    use BurnsAndResurrects, UserBurnableScope;

    protected $fillable = ['level']; // Чтобы не бросало исключение
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

    public function www(): string
    {
        return path('JapaneseWanikaniRadicals@show', $this->meaning);
    }
}
