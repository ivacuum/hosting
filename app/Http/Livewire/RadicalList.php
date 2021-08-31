<?php namespace App\Http\Livewire;

use App\Radical;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class RadicalList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection */
    public $radicals;

    public ?int $level;
    public bool $flat;
    public bool $range;
    public bool $showBurned = false;
    public bool $showLabels = false;

    public function mount(int $level = null, int $kanjiId = null, bool $range = false)
    {
        $this->flat = $kanjiId !== null;
        $this->level = $level;
        $this->range = $range;
        $this->radicals = Radical::query()
            ->orderBy('level')
            ->orderBy('meaning')
            ->userBurnable(auth()->id())
            ->when($kanjiId, fn (Builder $query) => $query->whereRelation('kanjis', 'kanji_id', $kanjiId))
            ->when($level, fn (Builder $query) => $query->where('level', $level))
            ->get(['id', 'level', 'character', 'meaning', 'image']);
    }

    public function shuffle()
    {
        $this->radicals = $this->radicals->shuffle();
    }
}
