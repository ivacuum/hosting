<?php namespace App\Http\Livewire;

use App\Vocabulary;
use Livewire\Component;

class VocabularyTrainer extends Component
{
    const MAX_HISTORY = 5;

    /** @var Vocabulary */
    public $vocab;

    public int $level = 1;
    public int $skipped = 0;
    public int $answered = 0;
    public int $revealed = 0;
    public bool $reveal = false;
    public bool $hiragana = true;
    public bool $openSettings = false;
    public array $history = [];
    public string $answer = '';

    public function check()
    {
        $this->openSettings = false;

        $answer = trim(mb_strtolower($this->answer));

        if ($answer === $this->vocab->toRomaji()) {
            event(new \App\Events\Stats\VocabularyAnsweredRomaji);
        } elseif ($answer === $this->vocab->toKatakana()) {
            event(new \App\Events\Stats\VocabularyAnsweredKatakana);
        } elseif ($answer === $this->vocab->kana) {
            event(new \App\Events\Stats\VocabularyAnsweredHiragana);
        } elseif ($answer === $this->vocab->character) {
            event(new \App\Events\Stats\VocabularyAnsweredKanji);
        }

        if (in_array($answer, $this->acceptedAnswers())) {
            $this->answer = '';
            $this->reveal = false;
            $this->answered++;
            $this->pushHistory();
            $this->pickRandomVocab();

            return;
        }

        if ($this->reveal) {
            $this->answer = '';
            $this->reveal = false;
            $this->pushHistory();
            $this->pickRandomVocab();

            return;
        }

        $this->reveal = true;
        $this->revealed++;

        event(new \App\Events\Stats\VocabularyAnswerRevealed);
    }

    public function decreaseLevel()
    {
        $this->validate(['level' => 'integer|min:1|max:6']);
        $this->level--;
        $this->openSettings = true;

        event(new \App\Events\Stats\VocabularyDifficultyDecreased);
    }

    public function increaseLevel()
    {
        $this->validate(['level' => 'integer|min:1|max:6']);
        $this->level++;
        $this->openSettings = true;

        event(new \App\Events\Stats\VocabularyDifficultyIncreased);
    }

    public function mount()
    {
        $this->pickRandomVocab();

        event(new \App\Events\Stats\VocabularyMounted);
    }

    public function skip()
    {
        $this->answer = '';
        $this->reveal = false;
        $this->skipped++;
        $this->openSettings = false;
        $this->pushHistory();
        $this->pickRandomVocab();

        event(new \App\Events\Stats\VocabularySkipped);
    }

    public function switchToHiragana()
    {
        $this->hiragana = true;
        $this->openSettings = true;

        event(new \App\Events\Stats\VocabularySwitchedToHiragana);
    }

    public function switchToKatakana()
    {
        $this->hiragana = false;
        $this->openSettings = true;

        event(new \App\Events\Stats\VocabularySwitchedToKatakana);
    }

    private function acceptedAnswers(): array
    {
        return [
            $this->vocab->toRomaji(),
            $this->vocab->toKatakana(),
            $this->vocab->kana,
            $this->vocab->character,
        ];
    }

    private function endLevel(): int
    {
        return min(60, $this->level * 10);
    }

    private function pickRandomVocab()
    {
        $this->vocab = Vocabulary::query()
            ->whereIn('level', range($this->startLevel(), $this->endLevel()))
            ->inRandomOrder()
            ->first();
    }

    private function pushHistory()
    {
        unset($this->history[self::MAX_HISTORY - 1]);

        array_unshift($this->history, [
            'www' => $this->vocab->www(),
            'meaning' => $this->vocab->meaning,
            'character' => $this->vocab->character,
        ]);
    }

    private function startLevel(): int
    {
        return max(1, $this->level * 10 - 9);
    }
}
