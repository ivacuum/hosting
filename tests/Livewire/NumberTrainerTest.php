<?php namespace Tests\Livewire;

use App\Http\Livewire\NumberTrainer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NumberTrainerTest extends TestCase
{
    use DatabaseTransactions;

    public function testEnglish()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('locale', 'en')
            ->set('number', 55)
            ->assertSet('spellOut', 'fifty-five')
            ->set('answer', 55)
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testGuessingNumbers()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('locale', 'en')
            ->set('number', 2)
            ->set('answer', 2)
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testGuessingSpellOut()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('locale', 'en')
            ->set('guessingSpellOut', true)
            ->set('number', 2)
            ->set('answer', 'two')
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testKoreanAsTranslit()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('locale', 'ko')
            ->set('guessingSpellOut', true)
            ->set('number', 3)
            ->assertSet('spellOut', '삼')
            ->set('answer', 'sam')
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testRightAnswerGetsCleared()
    {
        \Livewire::test(NumberTrainer::class)
            ->set('locale', 'en')
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
            ->set('locale', 'de')
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
            ->set('locale', 'ru')
            ->set('number', 3)
            ->assertSet('spellOut', 'три')
            ->set('answer', 4)
            ->call('check')
            ->assertSet('answer', 4)
            ->assertSet('reveal', true)
            ->assertSet('revealed', 1);
    }
}
