<?php

namespace Tests\Livewire;

use App\Factory\UserFactory;
use App\Factory\VocabularyFactory;
use App\Livewire\VocabularyList;
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

    public function testShowLabels()
    {
        VocabularyFactory::new()->withLevel(99)->create();

        $vocab = VocabularyFactory::new()->withLevel(99)->create();

        $this->be(UserFactory::new()->create());

        \Livewire::test(VocabularyList::class, ['level' => 99])
            ->toggle('showLabels')
            ->assertSee($vocab->character);
    }

    public function testShuffle()
    {
        VocabularyFactory::new()->withLevel(99)->create();

        $vocab = VocabularyFactory::new()->withLevel(99)->create();

        $this->be(UserFactory::new()->create());

        \Livewire::test(VocabularyList::class, ['level' => 99])
            ->call('shuffle')
            ->assertSee($vocab->character);
    }
}
