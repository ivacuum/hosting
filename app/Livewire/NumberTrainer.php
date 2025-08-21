<?php

namespace App\Livewire;

use App\Action\GetNumberLocalesAction;
use App\Domain\Japanese\Action\HiraganizeJapaneseNumberAction;
use App\Domain\LivewireEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

/**
 * @property string $spellOut
 */
class NumberTrainer extends Component
{
    use WithLocale;

    private const int MAXIMUM_AT_LEAST = 10;
    private const int MAXIMUM_AT_MOST = 10 ** self::MAXIMUM_ORDER_OF_MAGNITUDE;
    private const int MAXIMUM_ORDER_OF_MAGNITUDE = 8;
    private const int MINIMUM_AT_LEAST = 0;
    private const int MINIMAL_INTERVAL = 5;

    public int $number = 1;

    #[Locked]
    public int $exclude = 0;

    #[Validate(['integer', 'min:' . self::MAXIMUM_AT_LEAST, 'max:' . self::MAXIMUM_AT_MOST])]
    public int|null $maximum = 10;

    #[Validate(['integer', 'min:' . self::MINIMUM_AT_LEAST, 'max:' . self::MAXIMUM_AT_MOST - self::MINIMAL_INTERVAL])]
    public int|null $minimum = 0;

    #[Locked]
    public int $skipped = 0;

    #[Locked]
    public int $answered = 0;

    #[Locked]
    public int $revealed = 0;

    public bool $sayOutLoud = false;
    public bool $shouldReveal = false;
    public bool $customInterval = false;
    public bool $incorrectAnswer = false;
    public bool $guessingSpellOut = false;

    #[Locked]
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
        $answer = Str::trim(mb_strtolower($this->answer));

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
        $this->maximum = max($this->maximum / 10, 10);

        event(new \App\Events\Stats\NumberDecreaseMaximum);
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

    #[Computed]
    public function spellOut(): string
    {
        $formatter = new \NumberFormatter($this->lang, \NumberFormatter::SPELLOUT);

        return $formatter->format($this->number);
    }

    public function updatedCustomInterval()
    {
        if (!$this->customInterval) {
            $this->resetValidation('minimum');
            $this->resetValidation('maximum');

            $this->minimum = 0;

            $predefinedMaximums = collect(range(1, self::MAXIMUM_ORDER_OF_MAGNITUDE))
                ->map(fn (int $order) => 10 ** $order);

            if ($predefinedMaximums->doesntContain($this->maximum)) {
                $this->maximum = 10;
            }
        }

        match ($this->customInterval) {
            true => event(new \App\Events\Stats\NumberIntervalCustom),
            false => event(new \App\Events\Stats\NumberIntervalPredefined),
        };
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

    public function updatedMaximum()
    {
        $this->maximum = max(self::MAXIMUM_AT_LEAST, min($this->maximum, self::MAXIMUM_AT_MOST));
        $this->minimum = min($this->minimum, $this->maximum - self::MINIMAL_INTERVAL);

        $this->resetValidation('minimum');
    }

    public function updatedMinimum()
    {
        $this->minimum = max(self::MINIMUM_AT_LEAST, min($this->minimum, self::MAXIMUM_AT_MOST - self::MINIMAL_INTERVAL));
        $this->maximum = max($this->minimum + self::MINIMAL_INTERVAL, $this->maximum);

        $this->resetValidation('maximum');
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

    private function pickOrderOfMagnitude(): int
    {
        return random_int(1, mb_strlen($this->maximum) - 1);
    }

    private function pickRandomNumber()
    {
        if ($this->customInterval) {
            $this->number = random_int($this->minimum, $this->maximum);
        } else {
            $orderOfMagnitude = $this->pickOrderOfMagnitude();

            $this->number = match ($orderOfMagnitude) {
                1 => random_int(0, 10),
                default => random_int(10 ** ($orderOfMagnitude - 1), 10 ** $orderOfMagnitude),
            };
        }

        if ($this->number === $this->exclude) {
            $this->pickRandomNumber();

            return;
        }

        $this->sayOutLoud();
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
