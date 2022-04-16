<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class KoreanTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->get('korean')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}
