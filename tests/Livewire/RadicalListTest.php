<?php namespace Tests\Livewire;

use App\Factory\RadicalFactory;
use App\Http\Livewire\RadicalList;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RadicalListTest extends TestCase
{
    use DatabaseTransactions;

    public function testLevel()
    {
        $level = 99;
        $radical = RadicalFactory::new()->withLevel($level)->create();

        \Livewire::test(RadicalList::class, ['level' => $level])
            ->assertSee($radical->meaning);
    }
}
