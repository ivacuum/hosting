<?php namespace App\Http\Livewire;

use App\Services\HangulCyrrilizer;
use Livewire\Component;

class HangulTrainer extends Component
{
    public int $skipped = 0;
    public int $answered = 0;
    public int $revealed = 0;
    public bool $reveal = false;
    public string $jamo;
    public string $answer = '';

    public function check()
    {
        $answer = trim(mb_strtolower($this->answer));

        if (in_array($answer, $this->acceptedAnswers())) {
            $this->answered++;
            $this->next();

            return;
        }

        if ($this->reveal) {
            $this->next();

            return;
        }

        $this->reveal = true;
        $this->revealed++;
    }

    public function mount()
    {
        $this->pickRandomJamo();
    }

    private function acceptedAnswers(): array
    {
        return collect(HangulCyrrilizer::DICTIONARY[$this->jamo])
            ->map(fn ($answer) => str_replace('-', '', $answer))
            ->all();
    }

    private function next()
    {
        $this->answer = '';
        $this->reveal = false;
        $this->pickRandomJamo();
    }

    private function pickRandomJamo()
    {
        $this->jamo = collect(HangulCyrrilizer::DICTIONARY)
            ->keys()
            ->random();
    }
}
