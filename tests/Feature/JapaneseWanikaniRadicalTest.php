<?php

namespace Tests\Feature;

use App\Domain\Wanikani\Factory\RadicalFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class JapaneseWanikaniRadicalTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex(): void
    {
        $this->get('japanese/wanikani/radicals')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testShow(): void
    {
        $radical = RadicalFactory::new()->create();

        $this->get("japanese/wanikani/radicals/{$radical->meaning}")
            ->assertOk()
            ->assertViewHas('radical', $radical)
            ->assertSee($radical->meaning)
            ->assertHasCustomTitle();
    }
}
