<?php namespace Tests\Livewire;

use App\Factory\RadicalFactory;
use App\Factory\UserFactory;
use App\Http\Livewire\BurnRadical;
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
        $radical->burn($user->id);

        \Livewire::actingAs($user)
            ->test(BurnRadical::class, ['id' => $radical->id])
            ->call('toggleBurned');

        $this->assertNull($radical->burnable);
    }
}
