<?php namespace App\Http\Livewire;

use App\Vocabulary;
use Livewire\Component;

class VocabularyTrainer extends Component
{
    const MAX_HISTORY = 5;

    /** @var Vocabulary */
    public $vocab;

    public int $answered = 0;
    public bool $reveal = false;
    public array $history = [];
    public string $answer = '';

    public function check()
    {
        $answer = trim(mb_strtolower($this->answer));

        if ($answer === $this->vocab->toRomaji()) {
            event(new \App\Events\Stats\VocabularyAnsweredRomaji);
        } elseif ($answer === $this->vocab->kana) {
            event(new \App\Events\Stats\VocabularyAnsweredHiragana);
        } elseif ($answer === $this->vocab->character) {
            event(new \App\Events\Stats\VocabularyAnsweredKanji);
        }

        if (in_array($answer, [$this->vocab->toRomaji(), $this->vocab->kana, $this->vocab->character])) {
            $this->answer = '';
            $this->reveal = false;
            $this->answered++;
            $this->pushHistory();
            $this->pickRandomVocab();

            return;
        }

        $this->reveal = true;
    }

    public function mount()
    {
        $this->pickRandomVocab();

        event(new \App\Events\Stats\VocabularyMounted);
    }

    public function next()
    {
        $this->answer = '';
        $this->reveal = false;
        $this->pushHistory();
        $this->pickRandomVocab();

        event(new \App\Events\Stats\VocabularySkipped);
    }

    private function pickRandomVocab()
    {
        $this->vocab = Vocabulary::query()
            ->inRandomOrder()
            ->first();
    }

    private function pushHistory()
    {
        unset($this->history[self::MAX_HISTORY - 1]);

        array_unshift($this->history, [
            'www' => $this->vocab->www(),
            'kana' => $this->vocab->firstKana(),
            'meaning' => $this->vocab->meaning,
            'character' => $this->vocab->character,
        ]);
    }
}
