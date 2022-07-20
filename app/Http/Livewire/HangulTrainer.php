<?php namespace App\Http\Livewire;

use App\Action\CyrillicizeJamoAction;
use App\Action\GetJamoConsonantsAction;
use App\Action\GetJamoVowelsAction;
use App\Domain\HangulWhatToTrain;
use App\Domain\Locale;
use Illuminate\Support\Collection;
use Livewire\Component;

class HangulTrainer extends Component
{
    public int $skipped = 0;
    public int $answered = 0;
    public int $revealed = 0;
    public bool $reveal = false;
    public bool $italic = false;
    public bool $shiftPressed = false;
    public string $jamo;
    public string $answer = '';
    public string $exclude = '';
    public HangulWhatToTrain|int $whatToTrain = HangulWhatToTrain::AllTogether;

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

    public function updatedWhatToTrain()
    {
        $this->whatToTrain = is_int($this->whatToTrain)
            ? HangulWhatToTrain::from($this->whatToTrain)
            : $this->whatToTrain;

        $this->next();
    }

    private function acceptedAnswers(): array
    {
        return collect()
            ->when(app()->getLocale() === Locale::Rus->value, $this->appendCyrillicAnswers(...))
            ->push($this->romanizeJamo())
            ->unique()
            ->all();
    }

    private function appendCyrillicAnswers(Collection $answers)
    {
        return $answers->push(...app(CyrillicizeJamoAction::class)->execute($this->jamo))
            ->map(fn ($answer) => str_replace('-', '', $answer));
    }

    private function next()
    {
        $this->answer = '';
        $this->reveal = false;
        $this->exclude = $this->jamo;
        $this->pickRandomJamo();
    }

    private function pickRandomJamo()
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

    private function romanizeJamo(): string
    {
        return match ($this->jamo) {
            'ㅇ' => 'ng',
            default => \Transliterator::create('Hangul-Latin')->transliterate($this->jamo),
        };
    }
}
