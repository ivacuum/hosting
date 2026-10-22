<?php

namespace Tests\Livewire;

use App\Domain\Wanikani\Factory\VocabularyFactory;
use App\Domain\Wanikani\Livewire\VocabularyTrainer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VocabularyTrainerTest extends TestCase
{
    use DatabaseTransactions;

    public function testAnswerRightInHiragana(): void
    {
        $vocab = VocabularyFactory::new()
            ->withLevel(1)
            ->withKana('あした, あす')
            ->withCharacter('明日')
            ->create();

        \Event::fake(\App\Events\Stats\VocabularyAnsweredHiragana::class);

        \Livewire::test(VocabularyTrainer::class)
            ->call('setVocabId', $vocab->id)
            ->set('answer', 'あした')
            ->call('check')
            ->assertSet('answered', 1);

        \Event::assertDispatched(\App\Events\Stats\VocabularyAnsweredHiragana::class);
    }

    public function testAnswerRightInKanji(): void
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
            ->assertSet('answered', 1)
            ->assertSet('answer', '');

        \Event::assertDispatched(\App\Events\Stats\VocabularyAnsweredKanji::class);
    }

    public function testAnswerRightInKatakana(): void
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

    public function testAnswerRightInRomaji(): void
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

    public function testAnswerWrong(): void
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

    public function testDecreaseLevel(): void
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

    public function testIncreaseLevel(): void
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

    public function testSkip(): void
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

    public function testSkipAfterWrongAnswer(): void
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

    public function testSwitchToHiragana(): void
    {
        VocabularyFactory::new()->withLevel(1)->create();

        \Event::fake(\App\Events\Stats\VocabularySwitchedToHiragana::class);

        \Livewire::test(VocabularyTrainer::class, ['hiragana' => false])
            ->set('hiragana', true)
            ->assertSet('hiragana', true)
            ->assertSet('openSettings', true);

        \Event::assertDispatched(\App\Events\Stats\VocabularySwitchedToHiragana::class);
    }

    public function testSwitchToKatakana(): void
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
