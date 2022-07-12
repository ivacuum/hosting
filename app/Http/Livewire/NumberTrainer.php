<?php namespace App\Http\Livewire;

use App\Action\GetNumberLocalesAction;
use Illuminate\Http\Request;
use Livewire\Component;

/**
 * @property string $spellOut
 */
class NumberTrainer extends Component
{
    public int $number = 1;
    public int $exclude = 0;
    public int $maximum = 10;
    public int $skipped = 0;
    public int $answered = 0;
    public int $revealed = 0;
    public bool $reveal = false;
    public bool $sayOutLoud = false;
    public bool $guessingSpellOut = false;
    public array $locales = [];
    public string $lang = 'en';
    public string $answer = '';

    // Неправильно преобразует ссылки английской версии сайта
    // protected $queryString = [
    //     'lang' => ['except' => 'en'],
    // ];

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

    public function decreaseLevel()
    {
        $this->validate(['maximum' => 'integer|min:10|max:100000000']);
        $this->maximum /= 10;
    }

    public function getSpellOutProperty()
    {
        $formatter = new \NumberFormatter($this->lang, \NumberFormatter::SPELLOUT);

        return $formatter->format($this->number);
    }

    public function increaseLevel()
    {
        $this->validate(['maximum' => 'integer|min:10|max:100000000']);
        $this->maximum *= 10;
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
    }

    public function skip()
    {
        if ($this->reveal === false) {
            $this->skipped++;
        }

        $this->next();
        $this->emit('answer.focus');
    }

    public function updatedLang()
    {
        $this->next();
        $this->emit('lang.updated', $this->lang);
    }

    public function updatedSayOutLoud()
    {
        $this->next();
    }

    private function next()
    {
        $this->answer = '';
        $this->reveal = false;
        $this->exclude = $this->number;
        $this->pickRandomNumber();
    }

    private function pickRandomNumber()
    {
        $this->number = random_int(1, 10 ** $this->pickRange());

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
            $this->emit('say-out-loud');
        }
    }

    private function transliterate(string $text): string
    {
        return \Transliterator::create('NFD; Any-Latin; Latin-Ascii; NFC')
            ->transliterate($text);
    }
}
