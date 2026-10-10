<?php

namespace Tests\Feature;

use App\Livewire\NumberSynopsis;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TrainersNumbersSynopsisTest extends TestCase
{
    use DatabaseTransactions;
    use MockGetNumberLocales;

    public function testIndex()
    {
        $this->get('trainers/numbers/synopsis')
            ->assertOk()
            ->assertHasCustomTitle()
            ->assertSeeLivewire(NumberSynopsis::class);
    }

    public function testJapaneseReadings(): void
    {
        $this->get('trainers/numbers/synopsis?lang=ja')
            ->assertOk()
            ->assertSee('千二百三十四')
            ->assertSee("sen'nihyakusanjuuyon")
            ->assertSee('mainasuichi');
    }
}
