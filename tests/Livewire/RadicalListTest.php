<?php

namespace Tests\Livewire;

use App\Factory\RadicalFactory;
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
}
