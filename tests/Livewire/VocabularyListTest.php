<?php

namespace Tests\Livewire;

use App\Factory\VocabularyFactory;
use App\Http\Livewire\VocabularyList;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VocabularyListTest extends TestCase
{
    use DatabaseTransactions;

    public function testLevel()
    {
        VocabularyFactory::new()->withLevel(99)->create();

        $vocab = VocabularyFactory::new()->withLevel(99)->create();

        \Livewire::test(VocabularyList::class, ['level' => 99])
            ->assertSee($vocab->character);
    }
}
