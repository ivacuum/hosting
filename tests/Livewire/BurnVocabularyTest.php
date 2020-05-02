<?php namespace Tests\Livewire;

use App\Factory\UserFactory;
use App\Factory\VocabularyFactory;
use App\Http\Livewire\BurnVocabulary;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BurnVocabularyTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn()
    {
        $user = UserFactory::new()->create();
        $vocab = VocabularyFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(BurnVocabulary::class, ['id' => $vocab->id])
            ->call('toggleBurned');

        $this->assertSame($user->id, $vocab->burnable->user_id);
    }

    public function testResurrect()
    {
        $user = UserFactory::new()->create();
        $vocab = VocabularyFactory::new()->create();
        $vocab->burn($user->id);

        \Livewire::actingAs($user)
            ->test(BurnVocabulary::class, ['id' => $vocab->id])
            ->call('toggleBurned');

        $this->assertNull($vocab->burnable);
    }
}
