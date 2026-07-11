<?php

namespace Tests\Livewire;

use App\Domain\Wanikani\Action\BurnAction;
use App\Domain\Wanikani\Factory\RadicalFactory;
use App\Domain\Wanikani\Livewire\BurnRadical;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BurnRadicalTest extends TestCase
{
    use DatabaseTransactions;

    public function testBurn()
    {
        $user = UserFactory::new()->create();
        $radical = RadicalFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(BurnRadical::class, ['id' => $radical->id])
            ->call('toggleBurned');

        $this->assertSame($user->id, $radical->burnable->user_id);
    }

    public function testResurrect()
    {
        $user = UserFactory::new()->create();
        $radical = RadicalFactory::new()->create();
        app(BurnAction::class)->execute($radical, $user->id);

        \Livewire::actingAs($user)
            ->test(BurnRadical::class, ['id' => $radical->id])
            ->call('toggleBurned');

        $this->assertNull($radical->burnable);
    }
}
