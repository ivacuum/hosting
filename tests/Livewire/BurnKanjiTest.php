<?php namespace Tests\Livewire;

use App\Factory\KanjiFactory;
use App\Factory\UserFactory;
use App\Http\Livewire\BurnKanji;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BurnKanjiTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn()
    {
        $user = UserFactory::new()->create();
        $kanji = KanjiFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(BurnKanji::class, ['id' => $kanji->id])
            ->call('toggleBurned');

        $this->assertSame($user->id, $kanji->burnable->user_id);
    }

    public function testResurrect()
    {
        $user = UserFactory::new()->create();
        $kanji = KanjiFactory::new()->create();
        $kanji->burnable()->create(['user_id' => $user->id]);

        \Livewire::actingAs($user)
            ->test(BurnKanji::class, ['id' => $kanji->id])
            ->call('toggleBurned');

        $this->assertNull($kanji->burnable);
    }
}
