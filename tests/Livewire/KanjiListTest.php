<?php namespace Tests\Livewire;

use App\Factory\KanjiFactory;
use App\Http\Livewire\KanjiList;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class KanjiListTest extends TestCase
{
    use DatabaseTransactions;

    public function testLevel()
    {
        KanjiFactory::new()->withLevel(99)->create();

        $kanji = KanjiFactory::new()->withLevel(99)->create();

        \Livewire::test(KanjiList::class, ['level' => 99])
            ->assertSee($kanji->character);
    }
}
