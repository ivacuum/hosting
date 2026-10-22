<?php

namespace Tests\Livewire;

use App\Domain\Wanikani\Action\BurnAction;
use App\Domain\Wanikani\Factory\VocabularyFactory;
use App\Domain\Wanikani\Livewire\BurnVocabulary;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BurnVocabularyTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn(): void
    {
        $user = UserFactory::new()->create();
        $vocab = VocabularyFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(BurnVocabulary::class, ['id' => $vocab->id])
            ->call('toggleBurned');

        $this->assertSame($user->id, $vocab->burnable->user_id);
    }

    public function testResurrect(): void
    {
        $user = UserFactory::new()->create();
        $vocab = VocabularyFactory::new()->create();
        app(BurnAction::class)->execute($vocab, $user->id);

        \Livewire::actingAs($user)
            ->test(BurnVocabulary::class, ['id' => $vocab->id])
            ->call('toggleBurned');

        $this->assertNull($vocab->burnable);
    }
}
