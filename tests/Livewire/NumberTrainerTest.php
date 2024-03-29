<?php

namespace Tests\Livewire;

use App\Livewire\NumberTrainer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\MockGetNumberLocales;
use Tests\TestCase;

class NumberTrainerTest extends TestCase
{
    use DatabaseTransactions;
    use MockGetNumberLocales;

    public function testDetermineLocale()
    {
        \Livewire::withQueryParams(['lang' => 'de'])
            ->test(NumberTrainer::class)
            ->assertSet('lang', 'de');
    }

    public function testEnglish()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('lang', 'en')
            ->set('number', 55)
            ->assertSet('spellOut', 'fifty-five')
            ->set('answer', 55)
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testGuessingNumbers()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('lang', 'en')
            ->set('number', 2)
            ->set('answer', 2)
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testGuessingSpellOut()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('lang', 'en')
            ->set('guessingSpellOut', true)
            ->set('number', 2)
            ->set('answer', 'two')
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testKoreanAsTranslit()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('lang', 'ko')
            ->set('guessingSpellOut', true)
            ->set('number', 3)
            ->assertSet('spellOut', '삼')
            ->set('answer', 'sam')
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testMaximumIsNotLowerThan10()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('lang', 'en')
            ->call('decreaseLevel')
            ->set('number', 2)
            ->set('answer', 2)
            ->call('check')
            ->assertSet('answered', 1)
            ->assertSet('maximum', 10);
    }

    public function testReveal()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('lang', 'ru')
            ->set('number', 3)
            ->assertSet('spellOut', 'три')
            ->set('answer', 4)
            ->call('reveal')
            ->assertSet('answer', 4)
            ->assertSet('incorrectAnswer', false)
            ->assertSet('shouldReveal', true)
            ->assertSet('revealed', 1)
            ->call('reveal')
            ->assertSet('answer', '')
            ->assertSet('incorrectAnswer', false)
            ->assertSet('shouldReveal', false)
            ->assertSet('revealed', 1)
            ->set('number', 4)
            ->set('answer', 4)
            ->call('reveal')
            ->assertSet('answer', 4)
            ->assertSet('incorrectAnswer', false)
            ->assertSet('shouldReveal', true)
            ->assertSet('revealed', 2);
    }

    public function testRightAnswerGetsCleared()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('lang', 'en')
            ->set('number', 1)
            ->set('answer', 1)
            ->call('check')
            ->assertSet('answer', '');
    }

    public function testSkip()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('answer', 'about to skip')
            ->call('skip')
            ->assertSet('answer', '')
            ->assertSet('skipped', 1);
    }

    public function testSkipAfterWrongAnswer()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('answer', 'about to skip')
            ->call('check')
            ->call('skip')
            ->assertSet('answer', '')
            ->assertSet('answered', 0)
            ->assertSet('revealed', 1)
            ->assertSet('skipped', 0);
    }

    public function testSoftHyphensGetStripped()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('lang', 'de')
            ->set('guessingSpellOut', true)
            ->set('number', 63)
            ->assertSet('spellOut', 'drei­und­sechzig') // soft hyphens here
            ->set('answer', 'dreiundsechzig')
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testWrongAnswer()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('lang', 'ru')
            ->set('number', 3)
            ->assertSet('spellOut', 'три')
            ->set('answer', 4)
            ->call('check')
            ->assertSet('answer', 4)
            ->assertSet('incorrectAnswer', true)
            ->assertSet('shouldReveal', true)
            ->assertSet('revealed', 1)
            ->call('check')
            ->assertSet('answer', '')
            ->assertSet('incorrectAnswer', false)
            ->assertSet('shouldReveal', false)
            ->assertSet('revealed', 1);
    }
}
