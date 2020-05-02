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
        $level = 99;
        $kanji = KanjiFactory::new()->withLevel($level)->create();

        \Livewire::test(KanjiList::class, ['level' => $level])
            ->assertSee($kanji->character);
    }
}
