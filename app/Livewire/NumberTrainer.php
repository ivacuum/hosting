<?php

namespace App\Livewire;

use App\Action\GetNumberLocalesAction;
use App\Action\HiraganizeJapaneseNumberAction;
use App\Domain\LivewireEvent;
use Illuminate\Http\Request;
use Livewire\Component;

/**
 * @property string $spellOut
 */
class NumberTrainer extends Component
{
    use WithLocale;

    public int $number = 1;
    public int $exclude = 0;
    public int $maximum = 10;
    public int $skipped = 0;
    public int $answered = 0;
    public int $revealed = 0;
    public bool $sayOutLoud = false;
    public bool $shouldReveal = false;
    public bool $incorrectAnswer = false;
    public bool $guessingSpellOut = false;
    public array $locales = [];
    public string $lang = 'en';
    public string $answer = '';

    protected $queryString = [
        'lang' => ['except' => 'en'],
    ];

    public function acceptedAnswers(): array
    {
        $formatter = new \NumberFormatter($this->lang, \NumberFormatter::SPELLOUT);

        return $this->guessingSpellOut
            ? array_unique([
                preg_replace('/\x{AD}/u', '', $formatter->format($this->number)),
                $this->transliterate($formatter->format($this->number)),
            ])
            : [$this->number];
    }

    public function check()
    {
        $answer = trim(mb_strtolower($this->answer));

        if (in_array($answer, $this->acceptedAnswers())) {
            match ($this->guessingSpellOut) {
                true => event(new \App\Events\Stats\NumberAnsweredSpellOut),
                false => event(new \App\Events\Stats\NumberAnsweredNumber),
            };

            $this->answered++;
            $this->next();

            return;
        }

        $this->incorrectAnswer = true;
        $this->reveal();
    }

    public function decreaseLevel()
    {
        $this->validate(['maximum' => 'integer|min:10|max:100000000']);
        $this->maximum /= 10;

        event(new \App\Events\Stats\NumberDecreaseMaximum);
    }

    public function getSpellOutProperty(): string
    {
        $formatter = new \NumberFormatter($this->lang, \NumberFormatter::SPELLOUT);

        return $formatter->format($this->number);
    }

    public function increaseLevel()
    {
        $this->validate(['maximum' => 'integer|min:10|max:100000000']);
        $this->maximum *= 10;

        event(new \App\Events\Stats\NumberIncreaseMaximum);
    }

    public function mount(Request $request, GetNumberLocalesAction $getNumberLocales)
    {
        $this->locales = collect($getNumberLocales->execute())
            ->mapWithKeys(fn (string $locale) => [$locale => \Locale::getDisplayName($locale, \App::getLocale())])
            ->sort()
            ->all();

        $this->lang = in_array($request->input('lang'), array_keys($this->locales))
            ? $request->input('lang')
            : 'en';

        $this->pickRandomNumber();

        event(new \App\Events\Stats\NumberMounted);
    }

    public function reveal()
    {
        if ($this->shouldReveal) {
            $this->incorrectAnswer = false;
            $this->next();

            return;
        }

        $this->shouldReveal = true;
        $this->revealed++;

        event(new \App\Events\Stats\NumberAnswerRevealed);
    }

    public function skip()
    {
        if ($this->shouldReveal === false) {
            $this->skipped++;

            event(new \App\Events\Stats\NumberSkipped);
        }

        $this->next();
        $this->dispatch(LivewireEvent::FocusOnAnswer->name);
    }

    public function updatedGuessingSpellOut()
    {
        match ($this->guessingSpellOut) {
            true => event(new \App\Events\Stats\NumberGuessingSpellOut),
            false => event(new \App\Events\Stats\NumberGuessingNumber),
        };
    }

    public function updatedLang()
    {
        $this->next();
        $this->dispatch(LivewireEvent::LanguageChanged->name, $this->lang);

        event(new \App\Events\Stats\NumberLanguageSelected);
    }

    public function updatedSayOutLoud()
    {
        match ($this->sayOutLoud) {
            true => event(new \App\Events\Stats\NumberListen),
            false => event(new \App\Events\Stats\NumberRead),
        };

        $this->next();
    }

    private function next()
    {
        $this->answer = '';
        $this->shouldReveal = false;
        $this->exclude = $this->number;
        $this->pickRandomNumber();
    }

    private function pickRandomNumber()
    {
        $this->number = random_int(0, 10 ** $this->pickRange());

        if ($this->number === $this->exclude) {
            $this->pickRandomNumber();

            return;
        }

        $this->sayOutLoud();
    }

    private function pickRange(): int
    {
        return random_int(1, substr_count($this->maximum, 0));
    }

    private function sayOutLoud()
    {
        if ($this->sayOutLoud) {
            $this->dispatch(LivewireEvent::SayOutLoud->name, number: $this->number);
        }
    }

    private function transliterate(string $text): string
    {
        if ($this->lang === 'ja') {
            $text = app(HiraganizeJapaneseNumberAction::class)->execute($text);
        }

        return \Transliterator::create('NFD; Any-Latin; Latin-Ascii; NFC')
            ->transliterate($text);
    }
}
