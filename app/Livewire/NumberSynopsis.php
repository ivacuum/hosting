<?php

namespace App\Livewire;

use App\Action\GetNumberLocalesAction;
use App\Domain\Japanese\Action\HiraganizeJapaneseNumberAction;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

/**
 * @property array $numbers
 */
class NumberSynopsis extends Component
{
    public $input = 1234;
    public int $number = 1234;
    public array $locales = [];

    #[Url(except: 'en')]
    public string $lang = 'en';

    public function mount(GetNumberLocalesAction $getNumberLocales)
    {
        $this->locales = collect($getNumberLocales->execute())
            ->mapWithKeys(static fn (string $locale) => [$locale => \Locale::getDisplayName($locale, \App::getLocale())])
            ->sort()
            ->all();

        if (!array_key_exists($this->lang, $this->locales)) {
            $this->lang = 'en';
        }
    }

    #[Computed]
    public function numbers(): array
    {
        return [
            $this->number,
            -1,
            0,
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            13,
            14,
            15,
            16,
            17,
            18,
            19,
            20,
            21,
            22,
            23,
            24,
            25,
            26,
            27,
            28,
            29,
            30,
            40,
            50,
            60,
            70,
            80,
            90,
            100,
            101,
            111,
            121,
            1000,
            1111,
            9999,
            10_000,
            15_000,
            55_555,
            100_000,
            123_456,
            1_000_000,
        ];
    }

    public function spellOuts(int $number)
    {
        $formatter = new \NumberFormatter($this->lang, \NumberFormatter::SPELLOUT);
        $spellOut = $formatter->format($number);

        return array_unique([
            $spellOut,
            $this->transliteration($spellOut),
        ]);
    }

    public function transliteration(string $spellOut): string
    {
        if ($this->lang === 'ja') {
            $spellOut = app(HiraganizeJapaneseNumberAction::class)->execute($spellOut);
        }

        return \Transliterator::create('NFD; Any-Latin; Latin-Ascii; NFC')
            ->transliterate($spellOut);
    }

    public function updatedInput()
    {
        $this->validate();

        $this->number = $this->input;
    }

    protected function rules()
    {
        return [
            'input' => 'integer|min:0|max:10000000000',
        ];
    }
}
