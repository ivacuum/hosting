<?php

namespace Tests\Feature;

use App\Domain\Locale;
use Tests\TestCase;

class LivewireLocalizationTest extends TestCase
{
    public function testEnglish()
    {
        $this
            ->withHeaders([
                'X-Livewire' => '',
                'Referer' => 'http://localhost/en/trainers/numbers',
            ])
            ->post('livewire/update');

        $this->assertSame(Locale::Eng->value, app()->getLocale());
    }

    public function testRussian()
    {
        $this
            ->withHeaders([
                'X-Livewire' => '',
                'Referer' => 'http://localhost/trainers/numbers',
            ])
            ->post('livewire/update');

        $this->assertSame(Locale::Rus->value, app()->getLocale());
    }
}
