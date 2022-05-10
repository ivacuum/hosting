<?php namespace App\Http\Livewire;

use App\Action\BurnAction;
use App\Action\ResurrectAction;
use App\Scope\UserBurnableScope;
use App\Vocabulary;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class VocabularyList extends Component
{
    /** @var \Illuminate\Database\Eloquent\Collection|Vocabulary[] */
    public $vocabularies;
    public ?int $level;
    public bool $flat;
    public bool $range;
    public bool $showBurned = false;
    public bool $showLabels = false;
    public array $visible = [];

    public function burn(int $id, BurnAction $burn, ResurrectAction $resurrect)
    {
        $userId = auth()->id();

        /** @var Vocabulary $vocab */
        $vocab = Vocabulary::query()
            ->tap(new UserBurnableScope($userId))
            ->findOrFail($id);

        if ($vocab->burnable === null) {
            $burn->execute($vocab, $userId);
        } else {
            $resurrect->execute($vocab, $userId);
        }
    }

    public function mount(int $level = null, string $kanji = null, bool $range = false)
    {
        $this->flat = $kanji !== null;
        $this->level = $level;
        $this->range = $range;
        $this->vocabularies = Vocabulary::query()
            ->orderBy('level')
            ->orderBy('meaning')
            ->tap(new UserBurnableScope(auth()->id()))
            ->when($kanji, fn (Builder $query) => $query->where('character', 'LIKE', "%{$kanji}%"))
            ->when($level, fn (Builder $query) => $query->where('level', $level))
            ->get(['id', 'level', 'character', 'kana', 'meaning']);
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
