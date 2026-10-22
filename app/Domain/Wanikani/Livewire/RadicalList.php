<?php

namespace App\Domain\Wanikani\Livewire;

use App\Domain\Wanikani\Models\Burnable;
use App\Domain\Wanikani\Models\Radical;
use App\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class RadicalList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Domain\Wanikani\Models\Radical> */
    public $radicals;

    public int|null $level = null;
    public bool $flat;
    public bool $range = false;
    public bool $showBurned = false;
    public bool $showLabels = false;
    public array $burned = [];

    public function mount(int|null $kanjiId = null, #[CurrentUser] User|null $user = null): void
    {
        $this->flat = $kanjiId !== null;

        $this->radicals ??= Radical::query()
            ->when($kanjiId, static fn (Builder $query) => $query->whereRelation('kanjis', 'kanji_id', $kanjiId))
            ->when($this->level, fn (Builder $query) => $query->where('level', $this->level))
            ->orderBy('level')
            ->orderBy('meaning')
            ->get(Radical::LIST_COLUMNS);

        if ($user) {
            $this->burned = Burnable::query()
                ->where('user_id', $user->id)
                ->where('rel_type', (new Radical)->getMorphClass())
                ->whereIn('rel_id', $this->radicals->pluck('id'))
                ->pluck('rel_id')
                ->flip()
                ->all();
        }
    }

    public function render(): View
    {
        return view('livewire.radical-list');
    }

    public function shuffle(): void
    {
        $this->radicals = $this->radicals->shuffle();
    }
}
