<?php

namespace Tests\Livewire;

use App\Domain\Wanikani\Factory\RadicalFactory;
use App\Factory\UserFactory;
use App\Livewire\RadicalList;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RadicalListTest extends TestCase
{
    use DatabaseTransactions;

    public function testLevel()
    {
        RadicalFactory::new()->withLevel(99)->create();

        $radical = RadicalFactory::new()->withLevel(99)->create();

        \Livewire::test(RadicalList::class, ['level' => 99])
            ->assertSee($radical->meaning);
    }

    public function testShowLabels()
    {
        RadicalFactory::new()->withLevel(99)->create();

        $radical = RadicalFactory::new()->withLevel(99)->create();

        $this->be(UserFactory::new()->create());

        \Livewire::test(RadicalList::class, ['level' => 99])
            ->toggle('showLabels')
            ->assertSee($radical->meaning);
    }

    public function testShuffle()
    {
        RadicalFactory::new()->withLevel(99)->create();

        $radical = RadicalFactory::new()->withLevel(99)->create();

        $this->be(UserFactory::new()->create());

        \Livewire::test(RadicalList::class, ['level' => 99])
            ->call('shuffle')
            ->assertSee($radical->meaning);
    }
}
