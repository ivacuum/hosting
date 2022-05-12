<?php namespace App\Http\Livewire;

use App\Kanji;
use App\Scope\UserBurnableScope;
use App\Vocabulary;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class KanjiList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|Kanji[] */
    public $kanjis;

    public ?int $level;
    public ?int $similarId;
    public bool $flat;
    public bool $range;
    public bool $showBurned = false;
    public bool $showLabels = false;

    public function mount(int $level = null, int $similarId = null, int $radicalId = null, int $vocabularyId = null, bool $range = false)
    {
        $this->flat = $similarId !== null || $vocabularyId !== null;
        $this->level = $level;
        $this->range = $range;
        $this->similarId = $similarId;

        $this->kanjis = Kanji::query()
            ->orderBy('level')
            ->orderBy('meaning')
            ->tap(new UserBurnableScope(auth()->id()))
            ->when($radicalId, fn (Builder $query) => $query->whereRelation('radicals', 'radical_id', $radicalId))
            ->when($similarId, fn (Builder $query) => $query->whereRelation('similar', 'similar_id', $similarId))
            ->when($level, fn (Builder $query) => $query->where('level', $level))
            ->when($vocabularyId, function (Builder $query) use (&$characters, $vocabularyId) {
                $vocab = Vocabulary::findOrFail($vocabularyId);
                $characters = $vocab->splitKanjiCharacters();

                return $query->whereIn('character', $characters);
            })
            ->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading'])
            ->when($vocabularyId, function ($collection) use ($characters) {
                // Сортировка кандзи в порядке использования в словарном слове
                return $collection->map(function (Kanji $item) use ($characters) {
                    $item->sort = 0;

                    foreach ($characters as $i => $character) {
                        $item->sort = $character === $item->character ? $i * 10 : $item->sort;
                    }

                    return $item;
                })->sortBy('sort')->values();
            });
    }

    public function shuffle()
    {
        $this->kanjis = $this->kanjis->shuffle();
    }
}
