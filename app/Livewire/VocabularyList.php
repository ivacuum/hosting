<?php

namespace App\Livewire;

use App\Action\BurnAction;
use App\Action\ResurrectAction;
use App\Burnable;
use App\Scope\UserBurnableScope;
use App\User;
use App\Vocabulary;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class VocabularyList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|Vocabulary[] */
    public $vocabularies;
    public bool $flat;
    public bool $range = false;
    public bool $showBurned = false;
    public bool $showLabels = false;
    public array $burned = [];
    public array $visible = [];
    public int|null $level = null;

    public function burn(int $id, BurnAction $burn, ResurrectAction $resurrect)
    {
        $userId = auth()->id();

        /** @var Vocabulary $vocab */
        $vocab = Vocabulary::query()
            ->tap(new UserBurnableScope($userId))
            ->findOrFail($id);

        if ($vocab->burnable === null) {
            $burn->execute($vocab, $userId);

            $this->burned[$vocab->id] = 1;
        } else {
            $resurrect->execute($vocab, $userId);

            unset($this->burned[$vocab->id]);
        }
    }

    public function mount(#[CurrentUser] User|null $user = null, int|null $level = null, string|null $kanji = null)
    {
        $this->flat = $kanji !== null;
        $this->vocabularies = Vocabulary::query()
            ->orderBy('level')
            ->orderBy('meaning')
            ->when($kanji, fn (Builder $query) => $query->where('character', 'LIKE', "%{$kanji}%"))
            ->when($level, fn (Builder $query) => $query->where('level', $level))
            ->get(['id', 'level', 'character', 'kana', 'meaning']);

        if ($user) {
            $this->burned = Burnable::query()
                ->where('user_id', $user->id)
                ->where('rel_type', (new Vocabulary)->getMorphClass())
                ->whereIn('rel_id', $this->vocabularies->pluck('id'))
                ->pluck('rel_id')
                ->flip()
                ->all();
        }
    }

    public function reveal(int $id)
    {
        $this->visible[$id] = empty($this->visible[$id]);
    }

    public function shuffle()
    {
        $this->vocabularies = $this->vocabularies->shuffle();
    }
}
