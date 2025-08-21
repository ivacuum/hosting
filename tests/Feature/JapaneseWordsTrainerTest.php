<?php

namespace Tests\Feature;

use App\Domain\Wanikani\Factory\VocabularyFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWordsTrainerTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        VocabularyFactory::new()
            ->withLevel(1)
            ->create();

        $this->get('japanese/words-trainer')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}
