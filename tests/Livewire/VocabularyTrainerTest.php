<?php

namespace Tests\Livewire;

use App\Factory\VocabularyFactory;
use App\Http\Livewire\VocabularyTrainer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VocabularyTrainerTest extends TestCase
{
    use DatabaseTransactions;

    public function testAnswerRightInHiragana()
    {
        $vocab = VocabularyFactory::new()
            ->withLevel(1)
            ->withKana('とうきょうしょうけんとりひきじょ')
            ->withCharacter('東京証券取引所')
            ->create();

        \Event::fake(\App\Events\Stats\VocabularyAnsweredHiragana::class);

        \Livewire::test(VocabularyTrainer::class)
            ->call('setVocabId', $vocab->id)
            ->set('answer', 'とうきょうしょうけんとりひきじょ')
            ->call('check')
            ->assertSet('answered', 1);

        \Event::assertDispatched(\App\Events\Stats\VocabularyAnsweredHiragana::class);
    }

    public function testAnswerRightInKanji()
    {
        $vocab = VocabularyFactory::new()
            ->withLevel(1)
            ->withCharacter('東京証券取引所')
            ->create();

        \Event::fake(\App\Events\Stats\VocabularyAnsweredKanji::class);

        \Livewire::test(VocabularyTrainer::class)
            ->call('setVocabId', $vocab->id)
            ->set('answer', '東京証券取引所')
            ->call('check')
            ->assertSet('answered', 1);

        \Event::assertDispatched(\App\Events\Stats\VocabularyAnsweredKanji::class);
    }

    public function testAnswerRightInKatakana()
    {
        $vocab = VocabularyFactory::new()
            ->withLevel(1)
            ->withKana('ありがとう')
            ->create();

        \Event::fake(\App\Events\Stats\VocabularyAnsweredKatakana::class);

        \Livewire::test(VocabularyTrainer::class)
            ->call('setVocabId', $vocab->id)
            ->set('answer', 'アリガトウ')
            ->call('check')
            ->assertSet('answered', 1);

        \Event::assertDispatched(\App\Events\Stats\VocabularyAnsweredKatakana::class);
    }

    public function testAnswerRightInRomaji()
    {
        $vocab = VocabularyFactory::new()
            ->withLevel(1)
            ->withKana('ありがとう')
            ->create();

        \Event::fake(\App\Events\Stats\VocabularyAnsweredRomaji::class);

        \Livewire::test(VocabularyTrainer::class)
            ->call('setVocabId', $vocab->id)
            ->set('answer', 'arigatou')
            ->call('check')
            ->assertSet('answered', 1);

        \Event::assertDispatched(\App\Events\Stats\VocabularyAnsweredRomaji::class);
    }

    public function testAnswerWrong()
    {
        $vocab = VocabularyFactory::new()->withLevel(1)->create();

        \Event::fake(\App\Events\Stats\VocabularyAnswerRevealed::class);

        \Livewire::test(VocabularyTrainer::class)
            ->call('setVocabId', $vocab->id)
            ->set('answer', 'definitely wrong answer')
            ->call('check')
            ->assertSet('reveal', true)
            ->assertSet('revealed', 1);

        \Event::assertDispatched(\App\Events\Stats\VocabularyAnswerRevealed::class);
    }

    public function testDecreaseLevel()
    {
        VocabularyFactory::new()->withLevel(1)->create();
        VocabularyFactory::new()->withLevel(11)->create();

        \Event::fake(\App\Events\Stats\VocabularyDifficultyDecreased::class);

        \Livewire::test(VocabularyTrainer::class, ['level' => 2])
            ->call('decreaseLevel')
            ->assertSet('level', 1)
            ->assertSet('openSettings', true);

        \Event::assertDispatched(\App\Events\Stats\VocabularyDifficultyDecreased::class);
    }

    public function testIncreaseLevel()
    {
        VocabularyFactory::new()->withLevel(1)->create();
        VocabularyFactory::new()->withLevel(11)->create();

        \Event::fake(\App\Events\Stats\VocabularyDifficultyIncreased::class);

        \Livewire::test(VocabularyTrainer::class)
            ->call('increaseLevel')
            ->assertSet('level', 2)
            ->assertSet('openSettings', true);

        \Event::assertDispatched(\App\Events\Stats\VocabularyDifficultyIncreased::class);
    }

    public function testRightAnswerGetsCleared()
    {
        $vocab = VocabularyFactory::new()
            ->withLevel(1)
            ->withCharacter('東京証券取引所')
            ->create();

        \Event::fake(\App\Events\Stats\VocabularyAnsweredKanji::class);

        \Livewire::test(VocabularyTrainer::class)
            ->call('setVocabId', $vocab->id)
            ->set('answer', '東京証券取引所')
            ->call('check')
            ->assertSet('answer', '');

        \Event::assertDispatched(\App\Events\Stats\VocabularyAnsweredKanji::class);
    }

    public function testSkip()
    {
        VocabularyFactory::new()->withLevel(1)->create();

        \Event::fake(\App\Events\Stats\VocabularySkipped::class);

        \Livewire::test(VocabularyTrainer::class)
            ->set('answer', 'about to skip')
            ->call('skip')
            ->assertSet('answer', '')
            ->assertSet('skipped', 1);

        \Event::assertDispatched(\App\Events\Stats\VocabularySkipped::class);
    }

    public function testSkipAfterWrongAnswer()
    {
        VocabularyFactory::new()->withLevel(1)->create();

        \Event::fake(\App\Events\Stats\VocabularySkipped::class);

        \Livewire::test(VocabularyTrainer::class)
            ->set('answer', 'about to skip')
            ->call('check')
            ->call('skip')
            ->assertSet('answer', '')
            ->assertSet('answered', 0)
            ->assertSet('revealed', 1)
            ->assertSet('skipped', 0);

        \Event::assertNotDispatched(\App\Events\Stats\VocabularySkipped::class);
    }

    public function testSwitchToHiragana()
    {
        VocabularyFactory::new()->withLevel(1)->create();

        \Event::fake(\App\Events\Stats\VocabularySwitchedToHiragana::class);

        \Livewire::test(VocabularyTrainer::class, ['hiragana' => false])
            ->set('hiragana', true)
            ->assertSet('hiragana', true)
            ->assertSet('openSettings', true);

        \Event::assertDispatched(\App\Events\Stats\VocabularySwitchedToHiragana::class);
    }

    public function testSwitchToKatakana()
    {
        VocabularyFactory::new()->withLevel(1)->create();

        \Event::fake(\App\Events\Stats\VocabularySwitchedToKatakana::class);

        \Livewire::test(VocabularyTrainer::class)
            ->set('hiragana', false)
            ->assertSet('hiragana', false)
            ->assertSet('openSettings', true);

        \Event::assertDispatched(\App\Events\Stats\VocabularySwitchedToKatakana::class);
    }
}
