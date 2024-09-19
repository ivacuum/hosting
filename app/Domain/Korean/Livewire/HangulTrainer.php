<?php

namespace App\Domain\Korean\Livewire;

use App\Domain\Korean\Action\CyrillicizeJamoAction;
use App\Domain\Korean\Action\GetJamoConsonantsAction;
use App\Domain\Korean\Action\GetJamoVowelsAction;
use App\Domain\Korean\HangulWhatToTrain;
use App\Domain\Locale;
use App\Livewire\WithLocale;
use Illuminate\Support\Collection;
use Livewire\Component;

class HangulTrainer extends Component
{
    use WithLocale;

    public int $answered = 0;
    public int $revealed = 0;
    public bool $reveal = false;
    public bool $italic = false;
    public bool $shiftPressed = false;
    public string $jamo;
    public string $answer = '';
    public string $exclude = '';
    public HangulWhatToTrain $whatToTrain = HangulWhatToTrain::AllTogether;

    public function check()
    {
        $answer = trim(mb_strtolower($this->answer));

        if (in_array($answer, $this->acceptedAnswers())) {
            if ($answer === $this->romanizeJamo()) {
                event(new \App\Events\Stats\HangulAnsweredLatin);
            } elseif (in_array($answer, collect()->when(true, $this->appendCyrillicAnswers(...))->all())) {
                event(new \App\Events\Stats\HangulAnsweredCyrillic);
            }

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

        event(new \App\Events\Stats\HangulAnswerRevealed);
    }

    public function mount()
    {
        $this->pickRandomJamo();

        event(new \App\Events\Stats\HangulMounted);
    }

    public function updatedItalic()
    {
        match ($this->italic) {
            true => event(new \App\Events\Stats\HangulFontItalic),
            false => event(new \App\Events\Stats\HangulFontNormal),
        };
    }

    public function updatedShiftPressed()
    {
        match ($this->shiftPressed) {
            true => event(new \App\Events\Stats\HangulShiftPressed),
            false => event(new \App\Events\Stats\HangulShiftReleased),
        };
    }

    public function updatedWhatToTrain()
    {
        match ($this->whatToTrain) {
            HangulWhatToTrain::AllTogether => event(new \App\Events\Stats\HangulTrainAllTogether),
            HangulWhatToTrain::Consonants => event(new \App\Events\Stats\HangulTrainConsonants),
            HangulWhatToTrain::Vowels => event(new \App\Events\Stats\HangulTrainVowels),
        };

        $this->next();
    }

    protected function acceptedAnswers(): array
    {
        return collect()
            ->when(app()->getLocale() === Locale::Rus->value, $this->appendCyrillicAnswers(...))
            ->push($this->romanizeJamo())
            ->unique()
            ->all();
    }

    protected function appendCyrillicAnswers(Collection $answers)
    {
        return $answers->push(...app(CyrillicizeJamoAction::class)->execute($this->jamo))
            ->map(fn ($answer) => str_replace('-', '', $answer));
    }

    protected function next()
    {
        $this->answer = '';
        $this->reveal = false;
        $this->exclude = $this->jamo;
        $this->pickRandomJamo();
    }

    protected function pickRandomJamo()
    {
        $this->jamo = collect(match ($this->whatToTrain) {
            HangulWhatToTrain::AllTogether => [
                ...app(GetJamoConsonantsAction::class)->execute(),
                ...app(GetJamoVowelsAction::class)->execute(),
            ],
            HangulWhatToTrain::Consonants => app(GetJamoConsonantsAction::class)->execute(),
            HangulWhatToTrain::Vowels => app(GetJamoVowelsAction::class)->execute(),
        })->random();

        if ($this->jamo === $this->exclude) {
            $this->pickRandomJamo();
        }
    }

    protected function romanizeJamo(): string
    {
        return match ($this->jamo) {
            'ㅇ' => 'ng',
            default => \Transliterator::create('Hangul-Latin')->transliterate($this->jamo),
        };
    }
}
