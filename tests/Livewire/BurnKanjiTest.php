<?php

namespace Tests\Livewire;

use App\Domain\Wanikani\Action\BurnAction;
use App\Domain\Wanikani\Factory\KanjiFactory;
use App\Domain\Wanikani\Livewire\BurnKanji;
use App\Factory\UserFactory;
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
        app(BurnAction::class)->execute($kanji, $user->id);

        \Livewire::actingAs($user)
            ->test(BurnKanji::class, ['id' => $kanji->id])
            ->call('toggleBurned');

        $this->assertNull($kanji->burnable);
    }
}
