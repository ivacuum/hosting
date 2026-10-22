<?php

namespace Tests\Livewire;

use App\Domain\Wanikani\Factory\RadicalFactory;
use App\Domain\Wanikani\Livewire\RadicalList;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RadicalListTest extends TestCase
{
    use DatabaseTransactions;

    public function testLevel(): void
    {
        RadicalFactory::new()->withLevel(99)->create();

        $radical = RadicalFactory::new()->withLevel(99)->create();

        \Livewire::test(RadicalList::class, ['level' => 99])
            ->assertSee($radical->meaning);
    }

    public function testShowLabels(): void
    {
        RadicalFactory::new()->withLevel(99)->create();

        $radical = RadicalFactory::new()->withLevel(99)->create();

        $this->be(UserFactory::new()->create());

        \Livewire::test(RadicalList::class, ['level' => 99])
            ->toggle('showLabels')
            ->assertSee($radical->meaning);
    }

    public function testShuffle(): void
    {
        RadicalFactory::new()->withLevel(99)->create();

        $radical = RadicalFactory::new()->withLevel(99)->create();

        $this->be(UserFactory::new()->create());

        \Livewire::test(RadicalList::class, ['level' => 99])
            ->call('shuffle')
            ->assertSee($radical->meaning);
    }
}
