<?php namespace Tests\Feature;

use App\Factory\RadicalFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniRadicalTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('japanese/wanikani/radicals')
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }

    public function testShow()
    {
        $radical = RadicalFactory::new()->create();

        $this->get("japanese/wanikani/radicals/{$radical->meaning}")
            ->assertStatus(200)
            ->assertViewHas('radical', $radical)
            ->assertSee($radical->meaning)
            ->assertHasCustomTitle();
    }
}
