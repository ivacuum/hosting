<?php namespace Tests\Livewire;

use App\Factory\VocabularyFactory;
use App\Http\Livewire\VocabularyList;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VocabularyListTest extends TestCase
{
    use DatabaseTransactions;

    public function testLevel()
    {
        $level = 99;
        $vocab = VocabularyFactory::new()->withLevel($level)->create();

        \Livewire::test(VocabularyList::class, ['level' => $level])
            ->assertSee($vocab->character);
    }
}
