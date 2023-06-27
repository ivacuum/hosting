<?php

namespace Tests\Feature;

use App\Http\Livewire\NumberTrainer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TrainersNumbersTest extends TestCase
{
    use DatabaseTransactions;
    use MockGetNumberLocales;

    public function testIndex()
    {
        $this->get('trainers/numbers')
            ->assertOk()
            ->assertHasCustomTitle()
            ->assertSeeLivewire(NumberTrainer::class);
    }
}
