<?php namespace App\Http\Livewire;

use App\Radical;
use App\Scope\UserBurnableScope;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class RadicalList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|Radical[] */
    public $radicals;

    public int|null $level = null;
    public bool $flat;
    public bool $range = false;
    public bool $showBurned = false;
    public bool $showLabels = false;

    public function mount(int $kanjiId = null)
    {
        $this->flat = $kanjiId !== null;
        $this->radicals = Radical::query()
            ->tap(new UserBurnableScope(auth()->id()))
            ->when($kanjiId, fn (Builder $query) => $query->whereRelation('kanjis', 'kanji_id', $kanjiId))
            ->when($this->level, fn (Builder $query) => $query->where('level', $this->level))
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(['id', 'level', 'character', 'meaning', 'image']);
    }

    public function shuffle()
    {
        $this->radicals = $this->radicals->shuffle();
    }
}
