<?php

namespace Tests\Livewire;

use App\Domain\Wanikani\Factory\RadicalFactory;
use App\Factory\UserFactory;
use App\Livewire\BurnRadical;
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
        $radical->burnable()->create(['user_id' => $user->id]);

        \Livewire::actingAs($user)
            ->test(BurnRadical::class, ['id' => $radical->id])
            ->call('toggleBurned');

        $this->assertNull($radical->burnable);
    }
}
