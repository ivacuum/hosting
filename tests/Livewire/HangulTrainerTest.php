<?php

namespace Tests\Livewire;

use App\Livewire\HangulTrainer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HangulTrainerTest extends TestCase
{
    use DatabaseTransactions;

    public function testRightAnswer()
    {
        \Livewire::test(HangulTrainer::class)
            ->set('jamo', 'ㅎ')
            ->set('answer', 'х')
            ->call('check')
            ->assertSet('answered', 1)
            ->set('jamo', 'ㅎ')
            ->set('answer', 'h')
            ->call('check')
            ->assertSet('answered', 2);
    }

    public function testRightAnswerGetsCleared()
    {
        \Livewire::test(HangulTrainer::class)
            ->set('jamo', 'ㅎ')
            ->set('answer', 'х')
            ->call('check')
            ->assertSet('answer', '');
    }

    public function testRomanizedNg()
    {
        \Livewire::test(HangulTrainer::class)
            ->set('jamo', 'ㅇ')
            ->set('answer', 'ng')
            ->call('check')
            ->assertSet('answered', 1);
    }

    public function testWrongAnswer()
    {
        \Livewire::test(HangulTrainer::class)
            ->set('jamo', 'ㅎ')
            ->set('answer', 'w')
            ->call('check')
            ->assertSet('answer', 'w')
            ->assertSet('reveal', true)
            ->assertSet('revealed', 1)
            ->call('check')
            ->assertSet('answer', '')
            ->assertSet('reveal', false)
            ->assertSet('revealed', 1);
    }
}
