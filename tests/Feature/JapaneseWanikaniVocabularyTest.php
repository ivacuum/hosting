<?php namespace Tests\Feature;

use App\Factory\VocabularyFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniVocabularyTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('japanese/wanikani/vocabulary')
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }

    public function testShow()
    {
        $vocab = VocabularyFactory::new()->create();

        $this->get("japanese/wanikani/vocabulary/{$vocab->character}")
            ->assertStatus(200)
            ->assertViewHas(['vocab' => $vocab])
            ->assertSee($vocab->character)
            ->assertHasCustomTitle();
    }
}
